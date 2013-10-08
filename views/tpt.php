<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- less -->
    <?php echo Asset::less('template.less'); ?>
    <!-- scripts -->
    <?php echo Asset::js('modernizr-2.6.2-respond-1.1.0.min.js'); ?>
    <?php echo Asset::js('jquery.min.js'); ?>
    <?php echo Asset::js('jquery-ui.min.js'); ?>
    <?php echo Asset::js('bootstrap.min.js'); ?>
    <?php echo Asset::js('knockout.js'); ?>
    <?php echo Asset::js('template.js'); ?>
</head>
<body>

<?php echo $network; ?>
<?php echo $header; ?>

<div class="container">

    <?php echo $navigation; ?>
    <?php echo $content; ?>
    <?php echo $footer; ?>

</div>
</body>
</html>
