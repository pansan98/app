<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="width: 30%; display: inline-block;">
    <div>
        <div class="dz-image"><img src="<?php echo Config::get('const.root_relative') . '/storage/upload/' . $image_factory->getFileName(); ?>" style="width: 100%;" data-dz-thumbnail/></div>
        <div class="dz-details"><div class="dz-size"><span data-dz-size><strong><?php echo number_format($image_factory->getFileSize()); ?></strong>bytes</span></div></div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress style="width: 100%;"></span></div>

        <?php if($image_factory->getFileError()): ?>
        <div class="dz-error-message"><span data-dz-errormessage><?php echo $image_factory->getFileError(); ?></span></div>
        <?php endif; ?>
    </div>
    <div class="dz-error-mark"><button style="height: 60px;" type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-single-image-<?php echo $attr; ?>"><i class="material-icons" style="left: -11px; top: 4px; font-size: 24px;">content_cut</i></button></div>
</div>