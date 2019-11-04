<?php

namespace App\Http\Component\BlockForm;

class SingleImageForm extends BaseBlockForm {
    protected $type = 'image';
    
    public $template = 'single-image.blade.php';
    public $constraints = [];
    public $formName = '画像ファイル';
    
}