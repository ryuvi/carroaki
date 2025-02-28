<?php
function renderHead($title = 'Carro Aki') {
    echo '
    <!DOCTYPE html>
    <html lang="pt-br" style="min-height:100dvh;">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($title) . '</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch/dist/united/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="d-flex flex-column min-vh-100">
    ';
    // <link href="/src/bootstrap.min.css" rel="stylesheet">
    // <script src="/src/bootstrap.bundle.min.js"></script>
    // <link href="/src/united.min.css" rel="stylesheet">
    //<link href="/src/bootstrap-icons.min.css" rel="stylesheet">
    // <link rel="stylesheet" href="src/styles.css">
}
?>