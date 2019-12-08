<?php

namespace App\Http\Component\BlockForm;

class MediaImageForm extends BaseBlockForm {
    protected $type = 'image';
    
    public $template = 'media-image.blade.php';
    public $constraints = [];
    public $formName = '画像ファイル';
    
}