<div id="body" class="standard-body" data-title="<?php echo $title; ?>">
    <?php if (isset($modal)) echo $modal; ?>
    <?php if (isset($display)) echo $display; ?>
    <?php if (isset($navigation)) echo $navigation; ?>
    <div id="section" class="standard-section" data-model="<?php echo $section_model; ?>">
        <?php if (isset($header)) echo $header; ?>
        <?php if (isset($content)) echo $content; ?>
        <?php if (isset($footer)) echo $footer; ?>
    </div>
</div>