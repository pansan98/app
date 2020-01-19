@extends('base/base')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Storage management</h2>
            <small>
                This page opens the contents of the storage where the uploaded image is stored at the time of data creation.<br>
                registered after uploading will not be displayed.
            </small>
        </div>

        <div class="row clearfix">
            <?php if(!empty($storage_files)): ?>
            <?php foreach($storage_files as $file): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Update Date：<?php echo date('Y-m-d', $file['filetime']); ?></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right" style="top: 60px; background:none;box-shadow: none;">
                                    <li style="margin-bottom: 5px;">
                                        <form action="<?php echo Config::get('const.admin_root_path') . 'client-storage'; ?>" method="post" name="storage_upload">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <input type="hidden" name="file_name" value="<?php echo $file['filename']; ?>"/>
                                            <button type="submit" class="btn btn-xs btn-info btn-button-layout" aria-label="Left Align"><span class="glyphicon glyphicon-save">アップロード</span></button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="<?php echo Config::get('const.admin_root_path') . 'client-storage/' . $file['filename']; ?>" method="post" name="storage_delete">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <button type="submit" class="btn btn-xs btn-danger btn-button-layout" aria-label="Left Align"><span class="glyphicon glyphicon-trash">削除</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="animated-thumbnails" class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:void(0);" data-sub-html="storage_file">
                                    <img src="<?php echo $storage_path . $file['filename']; ?>" class="img-responsive" style="object-fit: cover; height:150px; width:100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else:?>
                <p>There is no data in storage.</p>
            <?php endif; ?>
        </div>

        <style>
            .btn-button-layout {
                float: right;
                margin-bottom: 5px;
            }
        </style>
    </div>
</section>
@endsection