<?php if (isset($header)) echo $header; ?>
<?php if (isset($body)) echo $body; ?>
<?php if (isset($footer)) echo $footer; ?>
<script type="text/javascript">
    $(function() {
        // add component
        window.standard.add_component('<?php echo $viewmodel_id; ?>', '<?php echo $viewmodel_name; ?>');
    });
</script>
<?php if ($only): ?>
<script type="text/javascript">
    $(function() {
        // set section
        window.standard.navigation.section_name('<?php echo $name; ?>');
    });
</script>
<?php endif; ?>