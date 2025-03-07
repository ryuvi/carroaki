<!DOCTYPE html>
<html lang="pt-br" style="min-height:100dvh;">
    <head>
        <?php require_once 'components/metas.php'; ?>
        <title><?php echo $title; ?></title>
        <?php require_once 'components/links.php'; ?>
    </head>
    <body>
        <div class="d-flex flex-column min-vh-100">
            <?php require_once 'components/navbar.php'; ?>

            <?php echo $content; ?>

            <?php require_once 'components/footer.php'; ?>
        </div>
    </body>
</html>