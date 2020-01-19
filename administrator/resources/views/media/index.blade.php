@extends('base/base')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Media management</h2>
            <small>
                This page opens the contents of the storage where the uploaded image is stored at the time of data creation.<br>
                registered after uploading will not be displayed.
            </small>
        </div>

        <div class="row clearfix">
            <div class="m-b-20 m-t--20">
                <a href="{{ route('media.create') }}" class="btn btn-primary m-t-15 waves-effect">新規作成</a>
            </div>
            <?php if(!empty($entities)): ?>
            <?php foreach($entities as $entity): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Update Date：<?php echo date('Y-m-d', strtotime($entity->updated_at)); ?></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right" style="top: 60px; background:none;box-shadow: none;">
                                    <li>
                                        <form action="<?php echo Config::get('const.admin_root_path') . 'media/' . $entity->id; ?>" method="post" name="storage_delete">
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
                                    <img src="<?php echo $storage_path . $entity->directory . '/' . $entity->file_name; ?>" class="img-responsive" style="object-fit: cover; height:150px; width:100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else:?>
                <p>There is no data in media.</p>
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