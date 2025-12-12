<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
    <h1>Error</h1>
    <p><?= esc($message ?? 'An error occurred') ?></p>
    <?php if (ENVIRONMENT === 'development' && isset($trace)): ?>
        <h3>Stack Trace:</h3>
        <pre><?php print_r($trace); ?></pre>
    <?php endif; ?>
</body>
</html>

