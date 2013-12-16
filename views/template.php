<!DOCTYPE html>
<html>
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
    <meta name="viewport" content="width=device-width, initial-scale=0.8, user-scalable=no">
    <!-- css -->
    <?php echo Asset::css('reset.css'); ?>
    <?php echo Asset::css('template.css'); ?>
    <!-- js -->
    <?php echo Asset::js('jquery.min.js'); ?>
    <?php echo Asset::js('dateformat.js'); ?>
    <?php echo Asset::js('bootstrap.min.js'); ?>
    <?php echo Asset::js('bootstrap-datetimepicker.min.js'); ?>
    <?php echo Asset::js('typeahead.min.js'); ?>
    <?php echo Asset::js('knockout.min.js'); ?>
    <?php echo Asset::js('knockout.mapping.min.js'); ?>
    <?php echo Asset::js('knockout.bindingHandlers.js'); ?>
    <?php echo Asset::js('knockout-bootstrap.min.js'); ?>
    <?php echo Asset::js('knockout.orderable.js'); ?>
    <?php echo Asset::js('jquery-ui.min.js'); ?>
    <?php echo Asset::js('jquery.tablesorter.min.js'); ?>
    <?php echo Asset::js('knockout-sortable.min.js'); ?>
    <?php echo Asset::js('helper.js'); ?>
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
