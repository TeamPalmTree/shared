<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        <?php if (!isset($title)): ?>
            <?php echo $site; ?>
        <?php else: ?>
            <?php echo $site . ' : ' . $title; ?>
        <?php endif; ?>
    </title>
    <!-- viewport -->
    <meta name="viewport" content="width=device-width">
    <!-- icon -->
    <link rel="icon" type="image/vnd.Microsoft.icon" href="/assets/img/icon.ico" />
    <!-- less -->
    <?php echo Asset::css('reset.css'); ?>
    <?php echo Asset::css('template.css'); ?>
    <!-- scripts -->
    <?php echo Asset::js('jquery.min.js'); ?>
    <?php echo Asset::js('jquery-ui.min.js'); ?>
    <?php echo Asset::js('bootstrap.min.js'); ?>
    <?php echo Asset::js('knockout.min.js'); ?>
    <?php echo Asset::js('knockout.mapping.min.js'); ?>
    <?php echo Asset::js('template.js'); ?>
</head>
<body>
<?php echo $modal; ?>
<div class="standard">
    <?php if (isset($display)) echo $display; ?>
    <?php echo $navigation; ?>
    <?php echo $section; ?>
</div>
</body>
</html>
