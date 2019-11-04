<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <label><?php echo ($block->getEnableRequired()) ? '<span>必須</span>' : '';?></label>
                <input type="text" class="form-control <?php echo $block->getValue('block_class', ''); ?>" name="<?php echo $block->getName(); ?>" value="<?php echo $block->getValue('sub_title', ''); ?>" autocomplete="off" style="margin-bottom: 0px;">
            </div>

            <div class="form-line">
                <?php foreach ($block->getHeadingType() as $k => $type): ?>
                <input type="radio" name="<?php echo $block->getName(); ?>_type" id="<?php echo $block->getName(); ?>_<?php echo $k; ?>"<?php echo in_array($block->getValue('heading_type', null), $block->getHeadingType()) ? ' checked' : ($k == $block->getDefaultHeadingType()) ? ' checked' : ''; ?>>
                <label for="<?php echo $block->getName(); ?>_<?php echo $k; ?>"><?php echo $type; ?></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>