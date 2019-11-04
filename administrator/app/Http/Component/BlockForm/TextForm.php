<?php

namespace App\Http\Component\BlockForm;

class TextForm extends BaseBlockForm {
    protected $type = 'text';
    
    public $template = 'text.blade.php';
    public $constraints = [];
    public $formName = 'テキスト';
    
}