<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <label><?php echo ($block->getEnableRequired()) ? '<span>必須</span>' : '';?></label>
                <input type="text" class="form-control <?php echo $block->getValue('block_class', ''); ?>" name="<?php echo $block->getName(); ?>" value="<?php echo $block->getValues(); ?>" autocomplete="off" style="margin-bottom: 0px;">
            </div>
        </div>
    </div>
</div>