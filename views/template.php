<!DOCTYPE html>
<html>
    <head>

        <!-- charset -->
        <meta charset="utf-8">

        <!-- title -->
        <title>
            <?php if (!isset($title)): ?>
                <?php echo $title; ?>
            <?php else: ?>
                <?php echo $name . ' : ' . $body->name; ?>
            <?php endif; ?>
        </title>

        <!-- viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=<?php echo $initial_scale; ?>, user-scalable=no">

        <!-- search -->
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords ?>" />

        <!-- facebook -->
        <meta property="og:title" content="<?php echo $name; ?>" />
        <meta property="og:type" content="<?php echo $facebook_type; ?>" />
        <meta property="og:image" content="<?php echo $image; ?>" />
        <meta property="og:url" content="<?php echo $url; ?>" />
        <meta property="og:description" content="<?php echo $description; ?>" />

        <!-- twitter -->
        <meta name="twitter:card" content="<?php echo $twitter_card; ?>" />
        <meta name="twitter:title" content="<?php echo $name; ?>" />
        <meta name="twitter:description" content="<?php echo $description; ?>" />
        <meta name="twitter:image" content="<?php echo $image; ?>" />

        <!-- css -->
        <?php echo Asset::css('reset.css'); ?>
        <?php echo Asset::css('template.css'); ?>

        <!-- js -->
        <?php echo Asset::js('jquery.min.js'); ?>
        <?php echo Asset::js('dateformat.js'); ?>
        <?php echo Asset::js('bootstrap.min.js'); ?>
        <?php echo Asset::js('bootstrap-datetimepicker.min.js'); ?>
        <?php echo Asset::js('typeahead.min.js'); ?>
        <?php echo Asset::js('ckeditor/ckeditor.js'); ?>
        <?php echo Asset::js('ckeditor/adapters/jquery.js'); ?>
        <?php echo Asset::js('knockout.min.js'); ?>
        <?php echo Asset::js('knockout.mapping.min.js'); ?>
        <?php echo Asset::js('knockout.bindingHandlers.js'); ?>
        <?php echo Asset::js('knockout-bootstrap.min.js'); ?>
        <?php echo Asset::js('knockout.orderable.js'); ?>
        <?php echo Asset::js('jquery-ui.min.js'); ?>
        <?php echo Asset::js('jquery.tablesorter.min.js'); ?>
        <?php echo Asset::js('knockout-sortable.min.js'); ?>
        <?php echo Asset::js('helper.js'); ?>
        <?php echo Asset::js('standard.js'); ?>
        <?php echo Asset::js('template.js'); ?>

    </head>
    <body>
        <?php echo $body; ?>
    </body>
</html>
