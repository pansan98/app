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
                            <i class="material-icons" style="text-align: center;display: inherit;">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                    </div>
                </div>
            </div>

            <div class="fallback">
                <input id="<?php echo $block->getName(); ?>_drop_zone_input" name="<?php echo $block->getName(); ?>[name]" accept="image/*" type="text" style="display: none;"/>
            </div>


            <script>

                class SingleImage_<?php echo $block->getName(); ?>_class {

                    constructor(name) {
                        this.unique_block_name = name;
                        this.endpoint = '<?php echo Config::get('const.admin_root_path'); ?>api/v1/upload-single';
                        this.root_relative = '<?php echo Config::get('const.root_relative'); ?>';
                        this.upload_node = '<div id="'+this.unique_block_name+'_FileUpLoad" class="'+this.unique_block_name+'_drop_zone"><div class="dz-message"><div class="drag-icon-cph"><i class="material-icons" style="text-align: center;display: inherit;">touch_app</i></div><h3>Drop files here or click to upload.</h3></div></div>';
                    }

                    dragCurrentImage() {
                        const api_endpoint = this.endpoint;
                        const api_unique_block_name = this.unique_block_name;
                        const this_class = this;

                        let drop_zone = document.querySelector('.'+this.unique_block_name+'_drop_zone');
                        drop_zone.addEventListener('dragover', function(e) {
                            e.preventDefault();
                        });

                        drop_zone.addEventListener('drop', function(e) {
                            e.preventDefault();
                            let fileList = (e.target.files) ? e.target.files : e.dataTransfer.files;

                            isFileLengthCheck(fileList, 1);

                            let fd = new FormData();

                            fd.append('files', fileList[0]);
                            fd.append('attr', api_unique_block_name);

                            if(fileList) {
                                $.ajax({
                                    url: api_endpoint,
                                    type: 'POST',
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json'
                                }).done(function(data) {

                                    let parse_data = JSON.parse(data.file_obj);
                                    var imageObj = {};
                                    imageObj.src = this_class.root_relative + 'storage/upload/'+parse_data.name;
                                    imageObj.name = parse_data.name;

                                    insertImage(imageObj);
                                    insertAttrSrc(imageObj);
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    console.log(xhr);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                });
                            }
                        });

                        function isFileLengthCheck (files, max) {
                            if(files.length > max) {
                                alert('ファイル数が超えています。');
                            }
                        }

                        function insertImage (imageObj) {
                            let insertNode = document.querySelector('.'+api_unique_block_name+'_single_uploaded_file_zone');
                            insertNode.innerHTML = '<p><img style="width:100%;" src="'+imageObj.src+'"></p><br><p>画像名</p><input type="text" name="'+api_unique_block_name+'[alt]"/><br><p class="btn btn-danger delete-single-image-'+api_unique_block_name+'"><a style="color: white;" href="javascript: void(0);">削除</a></p>';

                            // イベント登録
                            const deleteImageBtn = document.querySelector('.delete-single-image-'+api_unique_block_name);
                            deleteImageBtn.addEventListener('click', function(e) {
                                this_class.deleteCurrentImage();
                            });
                        }

                        function insertAttrSrc (imageObj) {
                            let insertSrcName = document.getElementById(api_unique_block_name+'_drop_zone_input');
                            insertSrcName.setAttribute('value', imageObj.name);
                        }
                    }

                    deleteCurrentImage() {
                        const api_endpoint = this.endpoint;
                        let insertSrcName = document.getElementById(this.unique_block_name + '_drop_zone_input');
                        let insertNode = document.querySelector('.' + this.unique_block_name + '_single_uploaded_file_zone');
                        let fileName = insertSrcName.getAttribute('value');

                        const this_class = this;

                        if(fileName !== '' && fileName !== 'undefined' && fileName != null) {
                            $.ajax({
                                url: api_endpoint,
                                type: 'POST',
                                data: {
                                    file: fileName,
                                    _method: 'DELETE'
                                },
                                dataType: 'json'
                            }).done(function(response) {
                                this_class.deleteAttrSrc(insertSrcName);
                                insertNode.innerHTML = this_class.upload_node;
                                this_class.dragCurrentImage();
                            }).fail(function(xhr, textStatus, errorThrown) {
                                //
                            })
                        }
                    }

                    deleteAttrSrc (srcNode) {
                        srcNode.setAttribute('value', '');
                    }
                }

                var singleImage_<?php echo $block->getName(); ?>_class = new SingleImage_<?php echo $block->getName(); ?>_class('<?php echo $block->getName(); ?>');
                singleImage_<?php echo $block->getName(); ?>_class.dragCurrentImage();
            </script>
        </div>
    </div>
</div>