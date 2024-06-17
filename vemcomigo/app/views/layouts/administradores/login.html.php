<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=TITLE_PAGE?></title>
    <meta name="Description" CONTENT="<?=META_DESCRIPTION?>">
	<meta name="robots" content="<?=META_ROBOTS?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo CSS_PATH?>/layouts/default.css" rel="stylesheet">
    <link rel="icon" href="/<?php echo IMG_PATH?>/layouts/favicon.png" type="image/x-icon">

</head>
<body>
    <div class="container-fluid"> <!-- Adiciona margem horizontal -->
        <div class="row">
            <?php echo HTML?>
        </div>
    </div>
    <!-- <script src="dist/script.js"></script> -->
</body>
</html>
