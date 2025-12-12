<?php

namespace Config;

/**
 * Mimes Configuration
 */
class Mimes
{
    /**
     * Map of extensions to mime types
     */
    public static array $mimes = [
        'hqx'   => ['application/mac-binhex40', 'application/mac-binhex', 'application/x-binhex40', 'application/x-mac-binhex40'],
        'cpt'   => 'application/mac-compactpro',
        'csv'   => ['text/csv', 'text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'],
        'bin'   => ['application/macbinary', 'application/mac-binary', 'application/octet-stream', 'application/x-binary', 'application/x-macbinary'],
        'dms'   => 'application/octet-stream',
        'lha'   => 'application/octet-stream',
        'lzh'   => 'application/octet-stream',
        'exe'   => ['application/octet-stream', 'application/x-msdownload'],
        'class' => 'application/octet-stream',
        'psd'   => ['application/x-photoshop', 'image/vnd.adobe.photoshop'],
        'so'    => 'application/octet-stream',
        'sea'   => 'application/octet-stream',
        'dll'   => 'application/octet-stream',
        'oda'   => 'application/oda',
        'pdf'   => ['application/pdf', 'application/force-download', 'application/x-download'],
        'ai'    => ['application/pdf', 'application/postscript'],
        'eps'   => 'application/postscript',
        'ps'    => 'application/postscript',
        'smi'   => 'application/smil',
        'smil'  => 'application/smil',
        'mif'   => 'application/vnd.mif',
        'xls'   => ['application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/download', 'application/vnd.ms-office', 'application/msword'],
        'ppt'   => ['application/vnd.ms-powerpoint', 'application/powerpoint', 'application/vnd.ms-office', 'application/msword'],
        'pptx'  => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        'wbxml' => 'application/wbxml',
        'wmlc'  => 'application/wmlc',
        'dcr'   => 'application/x-director',
        'dir'   => 'application/x-director',
        'dxr'   => 'application/x-director',
        'dvi'   => 'application/x-dvi',
        'gtar'  => 'application/x-gtar',
        'gz'    => 'application/x-gzip',
        'gzip'  => 'application/x-gzip',
        'php'   => ['application/x-php', 'application/x-httpd-php', 'application/php', 'text/php', 'text/x-php', 'application/x-httpd-php-source'],
        'php4'  => 'application/x-httpd-php',
        'php3'  => 'application/x-httpd-php',
        'phtml' => 'application/x-httpd-php',
        'phps'  => 'application/x-httpd-php-source',
        'js'    => ['application/x-javascript', 'text/plain'],
        'swf'   => 'application/x-shockwave-flash',
        'sit'   => 'application/x-stuffit',
        'tar'   => 'application/x-tar',
        'tgz'   => ['application/x-tar', 'application/x-gzip-compressed'],
        'z'     => 'application/x-compress',
        'xhtml' => 'application/xhtml+xml',
        'xht'   => 'application/xhtml+xml',
        'zip'   => ['application/x-zip', 'application/zip', 'application/x-zip-compressed', 'application/s-compressed', 'multipart/x-zip'],
        'rar'   => ['application/x-rar', 'application/rar', 'application/x-rar-compressed'],
        'mid'   => 'audio/midi',
        'midi'  => 'audio/midi',
        'mpga'  => 'audio/mpeg',
        'mp2'   => 'audio/mpeg',
        'mp3'   => ['audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'],
        'aif'   => ['audio/x-aiff', 'audio/aiff'],
        'aiff'  => ['audio/x-aiff', 'audio/aiff'],
        'aifc'  => 'audio/x-aiff',
        'ram'   => 'audio/x-pn-realaudio',
        'rm'    => 'audio/x-pn-realaudio',
        'rpm'   => 'audio/x-pn-realaudio-plugin',
        'ra'    => 'audio/x-realaudio',
        'rv'    => 'video/vnd.rn-realvideo',
        'wav'   => ['audio/x-wav', 'audio/wave', 'audio/wav'],
        'bmp'   => ['image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap'],
        'gif'   => 'image/gif',
        'jpg'   => ['image/jpeg', 'image/pjpeg'],
        'jpeg'  => ['image/jpeg', 'image/pjpeg'],
        'jpe'   => ['image/jpeg', 'image/pjpeg'],
        'jp2'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'j2k'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'jpf'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'jpg2'  => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'jpx'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'jpm'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'mj2'   => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'mjp2'  => ['image/jp2', 'video/mj2', 'image/jpx', 'image/jpm'],
        'png'   => ['image/png', 'image/x-png'],
        'webp'  => 'image/webp',
        'tif'   => 'image/tiff',
        'tiff'  => 'image/tiff',
        'css'   => ['text/css', 'text/plain'],
        'html'  => ['text/html', 'text/plain'],
        'htm'   => ['text/html', 'text/plain'],
        'shtml' => ['text/html', 'text/plain'],
        'txt'   => 'text/plain',
        'text'  => 'text/plain',
        'log'   => ['text/plain', 'text/x-log'],
        'rtx'   => 'text/richtext',
        'rtf'   => 'text/rtf',
        'xml'   => ['application/xml', 'text/xml', 'text/plain'],
        'xsl'   => ['application/xml', 'text/xsl', 'text/xml'],
        'mpeg'  => 'video/mpeg',
        'mpg'   => 'video/mpeg',
        'mpe'   => 'video/mpeg',
        'qt'    => 'video/quicktime',
        'mov'   => 'video/quicktime',
        'avi'   => ['video/x-msvideo', 'video/msvideo', 'video/avi', 'application/x-troff-msvideo'],
        'movie' => 'video/x-sgi-movie',
        'doc'   => ['application/msword', 'application/vnd.ms-office'],
        'docx'  => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip'],
        'dot'   => ['application/msword', 'application/vnd.ms-office'],
        'dotx'  => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword'],
        'xlsx'  => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/vnd.ms-excel', 'application/msword', 'application/x-zip'],
        'word'  => ['application/msword', 'application/octet-stream'],
        'xl'    => 'application/excel',
        'eml'   => 'message/rfc822',
        'json'  => ['application/json', 'text/json'],
        'svg'   => ['image/svg+xml', 'image/svg', 'application/xml', 'text/xml'],
        'svgz'  => ['image/svg+xml', 'image/svg', 'application/xml', 'text/xml'],
        'ico'   => ['image/x-icon', 'image/x-ico', 'image/vnd.microsoft.icon'],
        'webm'  => 'video/webm',
        'mp4'   => 'video/mp4',
        'm4v'   => 'video/mp4',
        'ogg'   => ['audio/ogg', 'video/ogg', 'application/ogg'],
        'ogv'   => ['video/ogg', 'application/ogg'],
        'oga'   => 'audio/ogg',
        'opus'  => 'audio/ogg',
        'woff'  => ['font/woff', 'application/font-woff'],
        'woff2' => ['font/woff2', 'application/font-woff2'],
        'ttf'   => ['font/ttf', 'application/x-font-ttf'],
        'otf'   => ['font/otf', 'application/x-font-opentype'],
        'eot'   => 'application/vnd.ms-fontobject',
    ];

    /**
     * Get mime type for extension
     */
    public static function guessTypeFromExtension(string $extension)
    {
        $extension = trim(strtolower($extension), '. ');

        if (!array_key_exists($extension, static::$mimes)) {
            return null;
        }

        return is_array(static::$mimes[$extension])
            ? static::$mimes[$extension][0]
            : static::$mimes[$extension];
    }

    /**
     * Get extension for mime type
     */
    public static function guessExtensionFromType(string $type, ?string $proposedExtension = null)
    {
        $type = trim(strtolower($type), '. ');

        foreach (static::$mimes as $extension => $mimeTypes) {
            if (is_string($mimeTypes) && $mimeTypes === $type) {
                return $extension;
            }
            if (is_array($mimeTypes) && in_array($type, $mimeTypes, true)) {
                return $extension;
            }
        }

        return $proposedExtension;
    }
}

