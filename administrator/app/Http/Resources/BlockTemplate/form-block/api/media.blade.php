<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="width: 30%; display: inline-block;">
    <div>
        <div class="dz-image"><img src="<?php echo Config::get('const.root_relative') . '/storage/upload/' . $image_factory->getFileName(); ?>" style="width: 100%;" data-dz-thumbnail/></div>
        <div class="dz-details"><div class="dz-size"><span data-dz-size><strong><?php echo number_format($image_factory->getFileSize()); ?></strong>bytes</span></div></div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress style="width: 100%;"></span></div>

        <?php if($image_factory->getFileError()): ?>
        <div class="dz-error-message"><span class="data-dz-errormessage"><?php echo $image_factory->getFileError(); ?></span></div>
        <?php endif; ?>

        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][width]" value="<?php echo $image_factory->getFileWidth(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][height]" value="<?php echo $image_factory->getFileHeight(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][extension]" value="<?php echo $image_factory->getFileExtension(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][mime_type]" value="<?php echo $image_factory->getFileType(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][directory]" value="<?php echo $image_factory->getFileDirectory(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][size]" value="<?php echo $image_factory->getFileSize(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][original_name]" value="<?php echo $image_factory->getFileOriginalName(); ?>"/>
        <input type="hidden" name="<?php echo $attr; ?>[<?php echo $number; ?>][file_name]" value="<?php echo $image_factory->getFileName(); ?>"/>
    </div>
    <div class="dz-error-mark"><button style="height: 60px;" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-single-image-<?php echo $attr; ?>"><i class="material-icons" style="left: -11px; top: 4px; font-size: 24px;">content_cut</i></button></div>
</div>