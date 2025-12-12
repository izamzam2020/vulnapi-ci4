<?php
/**
 * CLI Error Template
 */

echo "\n";
echo "ERROR: " . $message . "\n";
echo "File: " . ($file ?? 'Unknown') . "\n";
echo "Line: " . ($line ?? 'Unknown') . "\n";

if (isset($trace) && is_array($trace)) {
    echo "\nStack Trace:\n";
    foreach ($trace as $i => $item) {
        $file = $item['file'] ?? 'Unknown';
        $line = $item['line'] ?? 'Unknown';
        $function = $item['function'] ?? 'Unknown';
        $class = $item['class'] ?? '';
        $type = $item['type'] ?? '';
        
        echo "  #{$i} {$file}({$line}): {$class}{$type}{$function}()\n";
    }
}
echo "\n";

