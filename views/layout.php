<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <title>Veterinaria</title>
</head>
<body>
    <div class="layout">
        <?php include_once 'templates/_header.php'; ?>
        <main>
            <?php echo $contenido; ?>   
        </main>
        <?php include_once 'templates/_footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php echo $script ?? ''; ?>
    </div>
</body>
</html>

