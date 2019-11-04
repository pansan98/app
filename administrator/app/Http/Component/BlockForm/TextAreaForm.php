<?php

namespace App\Http\Component\BlockForm;

class TextAreaForm extends BaseBlockForm {
    protected $type = 'text';
    
    public $template = 'textarea.blade.php';
    public $constraints = [];
    public $formName = 'テキストエリア';
    public $rows;
    
    public function formInit($options)
    {
        parent::formInit($options);
    
        if(isset($options['rows'])) {
            $this->setRows($options['rows']);
        }
    }
    
    protected function setRows($rows)
    {
        $this->rows = $rows;
        
        return $this;
    }
    
    public function getRows()
    {
        return $this->rows;
    }
    
}