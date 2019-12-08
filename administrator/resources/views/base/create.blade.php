@extends('base.base')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $blocks->getName(); ?>
                            </h2>
                        </div>
                        <div class="m-b-20 m-l-10">
                            <a href="javascript:void(0);" onclick="submitForm();" class="btn btn-primary m-t-15 waves-effect">登録</a>
                        </div>
                        <div class="body">
                            <form action="<?php echo $action; ?>" method="post" id="form_edit" enctype="multipart/form-data">
                                <?php if($status == 'edit'): ?>
                                <input type="hidden" name="_method" value="PUT">
                                <?php endif; ?>
                                <?php echo $blocks->renderBlocks(); ?>

                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            </form>
                            <p class="btn btn-danger"><a style="color: white;" href="<?php echo Config::get('const.admin_root_path') . $blocks->getActionName(); ?>">戻る</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function submitForm()
            {
                var $form = document.getElementById('form_edit');
                $form.submit();
            }
        </script>
    </section>
@endsection
