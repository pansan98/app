<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>画像は1枚まで登録できます。</h2>
            </div>
            <div class="body <?php echo $block->getName(); ?>_single_uploaded_file_zone">
                <div id="<?php echo $block->getName(); ?>_FileUpLoad" class="<?php echo $block->getName(); ?>_drop_zone">
                    <div class="dz-message">
                        <div class="drag-icon-cph">
                            <i class="material-icons">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                        <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                    </div>
                </div>
            </div>

            <div class="fallback">
                <input id="<?php echo $block->getName(); ?>_drop_zone_input" name="<?php echo $block->getName(); ?>" accept="image/*" type="text" style="display: none;"/>
            </div>

            <script>
                var endpoint = '<?php echo config('const.admin_root_path'); ?>api/v1/upload-single';

                function dragImage() {
                    var drop_zone = document.querySelector('.<?php echo $block->getName(); ?>_drop_zone');
                    drop_zone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                    });

                    drop_zone.addEventListener('drop', function(e) {

                        e.preventDefault();
                        var fileList = (e.target.files) ? e.target.files : e.dataTransfer.files;

                        isFileLengthCheck(fileList, 1);

                        var fd = new FormData();

                        fd.append('files', fileList[0]);
                        fd.append('attr', '<?php echo $block->getName(); ?>');

                        if(fileList) {
                            $.ajax({
                                url: endpoint,
                                type: 'POST',
                                data: fd,
                                processData: false,
                                contentType: false,
                                dataType: 'json'
                            }).done(function(data) {
                                var parse_data = JSON.parse(data.file_obj);
                                var imageObj = {};
                                imageObj.src = '<?php echo config('const.root_relative'); ?>storage/upload/'+parse_data.name;
                                insertImage(imageObj.src);
                                insertAttrSrc(imageObj.src);
                            }).fail(function(xhr, textStatus, errorThrown) {
                                console.log(xhr);
                                console.log(textStatus);
                                console.log(errorThrown);
                            });
                        }
                    });

                    function isFileLengthCheck(files, max) {
                        if(files.length > max) {
                            alert('ファイル数が超えています。');
                        }
                    }

                    function insertImage(src) {
                        var insertNode = document.querySelector('.<?php echo $block->getName(); ?>_single_uploaded_file_zone');
                        insertNode.innerHTML = '<p><img style="width:100%;" src="'+src+'"></p>';
                    }

                    function insertAttrSrc(src) {
                        var insertSrcName = document.getElementById('<?php echo $block->getName(); ?>_drop_zone_input');
                        insertSrcName.setAttribute('value', imageObj.src);
                    }
                }

                dragImage();
            </script>
        </div>
    </div>
</div>