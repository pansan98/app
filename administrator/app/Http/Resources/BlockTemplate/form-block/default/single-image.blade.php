<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>画像は1枚まで登録できます。</h2>
            </div>
            <div class="body">
                <div id="<?php echo $block->getName(); ?>_FileUpLoad" class="<?php echo $block->getName(); ?>_drop_zone">
                    <div class="dz-message">
                        <div class="drag-icon-cph">
                            <i class="material-icons">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                        <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                    </div>
                    <div class="fallback">
                        <input id="<?php echo $block->getName(); ?>_drop_zone" name="<?php echo $block->getName(); ?>" accept="image/*" type="file" style="display: none;"/>
                    </div>
                </div>
            </div>

            <script>
                var endpoint = '<?php echo config('const.admin_root_path'); ?>api/v1/upload-single';

                function dragImage() {
                    var drop_zone = document.querySelector('.<?php echo $block->getName(); ?>_drop_zone');
                    drop_zone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                    });

                    drop_zone.addEventListener('drop', function(e) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('input[name = _token]').val()
                            }
                        });

                        //var requestData = new FormData();

                        e.preventDefault();
                        var fileList = (e.target.files) ? e.target.files : e.dataTransfer.files;
                        var datas = {};

                        datas.files = fileList;
                        datas.attr = '<?php echo $block->getName(); ?>';

                        //requestData.append('files', fileList);
                        //requestData.append('attr', '');

                        console.log(datas);

                        if(fileList) {
                            $.ajax({
                                url: endpoint,
                                type: 'POST',
                                data: datas,
                                processData: false,
                                contentType: false
                            }).done(function(data) {
                                console.log(data);
                            }).fail(function(xhr, textStatus, errorThrown) {
                                console.log(xhr);
                                console.log(textStatus);
                                console.log(errorThrown);
                            });
                        }
                    });
                }

                dragImage();
            </script>
        </div>
    </div>
</div>