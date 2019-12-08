<h2 class="card-inside-title"><?php echo $block->getFormName(); ?></h2>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>画像は1枚まで登録できます。</h2>
            </div>
            <div class="body <?php echo $block->getName(); ?>_single_uploaded_file_zone">

                <?php if($block->getValue('filename')): ?>
                    <div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="width: 30%; display: inline-block;">
                        <div>
                            <div class="dz-image"><img src="<?php echo realpath(Config::get('const.root_relative') . '/../storage/upload/') . $block->getValue('filename'); ?>" style="width: 100%;" data-dz-thumbnail/></div>
                            <div class="dz-details"><div class="dz-size"><span data-dz-size><strong><?php echo number_format($block->getValue('filesize')); ?></strong>bytes</span></div></div>
                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress style="width: 100%;"></span></div>
                        </div>
                        <div class="dz-error-mark"><button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete-single-image-<?php echo $block->getName(); ?>"><i class="material-icons" style="left: -11px; top: 4px; font-size: 24px;">content_cut</i></button></div>
                    </div>

                <?php else: ?>

                <div id="<?php echo $block->getName(); ?>_FileUpLoad" class="<?php echo $block->getName(); ?>_drop_zone">
                    <div class="dz-message">
                        <div class="drag-icon-cph">
                            <i class="material-icons" style="text-align: center;display: inherit;">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="fallback">
                <input id="<?php echo $block->getName(); ?>_drop_zone_input" name="<?php echo $block->getName(); ?>[name]" accept="image/*" type="text" style="display: none;"/>
            </div>


            <script>

                class SingleImage_<?php echo $block->getName(); ?>_class {

                    constructor(name) {
                        this.unique_block_name = name;
                        this.endpoint = '<?php echo Config::get('const.admin_root_path'); ?>api/v1/upload-media';
                        this.root_relative = '<?php echo Config::get('const.root_relative'); ?>';
                        this.upload_node = '<div id="'+this.unique_block_name+'_FileUpLoad" class="'+this.unique_block_name+'_drop_zone"><div class="dz-message"><div class="drag-icon-cph"><i class="material-icons" style="text-align: center;display: inherit;">touch_app</i></div><h3>Drop files here or click to upload.</h3></div></div>';
                        this.mainScreen = document.getElementsByClassName('<?php echo $block->getName(); ?>_single_uploaded_file_zone');
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

                            this_class.enableLoading();

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

                                    insertImage(data);
                                    insertAttrSrc(data);
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    console.log(xhr);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }).then(function() {
                                    this_class.disableLoading();
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

                            insertNode.innerHTML = imageObj.html;

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
                        this.enableLoading();

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
                            }).then(function() {
                                this_class.disableLoading();
                            });
                        }
                    }

                    deleteAttrSrc (srcNode) {
                        srcNode.setAttribute('value', '');
                    }

                    enableLoading () {

                        this.mainScreen[0].classList.add('loading-icons-process');

                        // source copy
                        const loading_html = '<div class="sk-chase">\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '  <div class="sk-chase-dot"></div>\n' +
                            '</div>';

                        this.mainScreen[0].insertAdjacentHTML('afterbegin', loading_html);
                    }

                    disableLoading () {
                        this.mainScreen[0].classList.remove('loading-icons-process');
                        // var loading_html = this.mainScreen[0].querySelector('.sk-chase');
                        // this.mainScreen[0].removeChild(loading_html);
                    }
                }

                var singleImage_<?php echo $block->getName(); ?>_class = new SingleImage_<?php echo $block->getName(); ?>_class('<?php echo $block->getName(); ?>');
                singleImage_<?php echo $block->getName(); ?>_class.dragCurrentImage();
            </script>

            <style>
                .loading-icons-process::before {
                    content: '';
                    width: 100%;
                    height: 100%;
                    background: #0c5460;
                    opacity: 0.7;
                    position: absolute;
                    top: 0;
                    left: 0;
                    display: inline-block;
                }

                .sk-chase {
                    width: 40px;
                    height: 40px;
                    position: relative;
                    animation: sk-chase 2.5s infinite linear both;
                    left: 47%;
                }

                .sk-chase-dot {
                    width: 100%;
                    height: 100%;
                    position: absolute;
                    left: 0;
                    top: 0;
                    animation: sk-chase-dot 2.0s infinite ease-in-out both;
                }

                .sk-chase-dot:before {
                    content: '';
                    display: block;
                    width: 25%;
                    height: 25%;
                    background-color: #fff;
                    border-radius: 100%;
                    animation: sk-chase-dot-before 2.0s infinite ease-in-out both;
                }

                .sk-chase-dot:nth-child(1) { animation-delay: -1.1s; }
                .sk-chase-dot:nth-child(2) { animation-delay: -1.0s; }
                .sk-chase-dot:nth-child(3) { animation-delay: -0.9s; }
                .sk-chase-dot:nth-child(4) { animation-delay: -0.8s; }
                .sk-chase-dot:nth-child(5) { animation-delay: -0.7s; }
                .sk-chase-dot:nth-child(6) { animation-delay: -0.6s; }
                .sk-chase-dot:nth-child(1):before { animation-delay: -1.1s; }
                .sk-chase-dot:nth-child(2):before { animation-delay: -1.0s; }
                .sk-chase-dot:nth-child(3):before { animation-delay: -0.9s; }
                .sk-chase-dot:nth-child(4):before { animation-delay: -0.8s; }
                .sk-chase-dot:nth-child(5):before { animation-delay: -0.7s; }
                .sk-chase-dot:nth-child(6):before { animation-delay: -0.6s; }

                @keyframes sk-chase {
                    100% { transform: rotate(360deg); }
                }

                @keyframes sk-chase-dot {
                    80%, 100% { transform: rotate(360deg); }
                }

                @keyframes sk-chase-dot-before {
                    50% {
                        transform: scale(0.4);
                    } 100%, 0% {
                          transform: scale(1.0);
                      }
                }
            </style>
        </div>
    </div>
</div>