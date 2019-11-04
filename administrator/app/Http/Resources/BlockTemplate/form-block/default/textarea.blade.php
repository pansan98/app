<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <label><?php echo ($block->getEnableRequired()) ? '<span>必須</span>' : '';?></label>
                <textarea class="form-control <?php echo $block->getValue('block_class', ''); ?>" rows="<?php echo $block->getValue('rows', 5); ?>" type="text" name="<?php echo $block->getName(); ?>"><?php echo $block->getValues(); ?></textarea>
            </div>
        </div>
    </div>
</div>