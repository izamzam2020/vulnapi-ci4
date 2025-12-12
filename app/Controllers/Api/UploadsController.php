<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Uploads Controller
 * 
 * VULNERABILITIES:
 * - Insecure File Upload: Only checks filename extension
 * - No content-type validation
 * - No magic byte verification
 * - Saves with original filename (path traversal possible)
 * - Files served by Nginx (PHP execution possible)
 */
class UploadsController extends BaseController
{
    protected string $uploadPath;

    public function __construct()
    {
        $this->uploadPath = FCPATH . 'uploads';
        
        // Create uploads directory if it doesn't exist
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    /**
     * POST /api/uploads
     * 
     * VULNERABILITIES:
     * - Only validates extension via filename (can be bypassed)
     * - No magic byte/content-type validation
     * - Original filename preserved (allows special characters)
     * - Uploaded PHP files can be executed
     */
    public function upload()
    {
        $file = $this->request->getFile('file');

        if (!$file) {
            return $this->error('No file uploaded', 400);
        }

        if ($file->hasMoved()) {
            return $this->error('File has already been moved', 400);
        }

        $filename = $file->getName();
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // VULNERABILITY: Weak extension check - only blocklist based
        // Can be bypassed with:
        // - Double extensions: shell.php.jpg
        // - Case variations: shell.PHP (some servers)
        // - Null bytes: shell.php%00.jpg (older PHP)
        // - Alternative extensions: .phtml, .phar, .php5
        $blockedExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar'];
        
        if (in_array($extension, $blockedExtensions)) {
            // VULNERABILITY: This check is easily bypassed
            return $this->error('PHP files are not allowed', 400, 'BLOCKED_EXTENSION');
        }

        // VULNERABILITY: Using original filename without sanitization
        // Could lead to path traversal or overwriting existing files
        $targetPath = $this->uploadPath . DIRECTORY_SEPARATOR . $filename;

        // VULNERABILITY: No content-type or magic byte validation
        // A file named "image.jpg" could actually contain PHP code
        
        try {
            // Get file size before moving
            $fileSize = $file->getSize();
            
            $file->move($this->uploadPath, $filename);
        } catch (\Exception $e) {
            return $this->error('Upload failed: ' . $e->getMessage(), 500);
        }

        $fileUrl = base_url('uploads/' . $filename);

        return $this->success([
            'message'  => 'File uploaded successfully',
            'filename' => $filename,
            'url'      => $fileUrl,
            'size'     => $fileSize
        ], 201);
    }

    /**
     * GET /api/uploads
     * 
     * VULNERABILITY: No authentication - lists all uploaded files
     * Information disclosure - reveals uploaded filenames
     */
    public function list()
    {
        // VULNERABILITY: No auth check - anyone can list files
        
        $files = [];
        
        if (is_dir($this->uploadPath)) {
            $items = scandir($this->uploadPath);
            
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..') {
                    $filePath = $this->uploadPath . DIRECTORY_SEPARATOR . $item;
                    $files[] = [
                        'name'     => $item,
                        'url'      => base_url('uploads/' . $item),
                        'size'     => filesize($filePath),
                        'modified' => date('Y-m-d H:i:s', filemtime($filePath))
                    ];
                }
            }
        }

        return $this->success([
            'files' => $files,
            'count' => count($files),
            'path'  => '/uploads/' // VULNERABILITY: Reveals directory structure
        ]);
    }
}

