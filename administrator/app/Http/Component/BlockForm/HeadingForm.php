<?php

namespace App\Http\Component\BlockForm;

class HeadingForm extends BaseBlockForm {
    protected $type = 'text';
    
    public $template = 'heading.blade.php';
    public $constraints = [];
    public $formName = '見出し';
    
    public $headingTypes = ['h1' => '大見出し', 'h2' => '中見出し', 'h3' => '小見出し'];
    public $defaultType = 'h1';
    
    public function formInit($options)
    {
        parent::formInit($options);
        
        $this->setHeadingType($options['heading_types']);
        $this->setDefaultHeadingType($options['default_heading_type']);
    }
    
    public function filterDefaultOptions($options)
    {
        $options['heading_types'] = $this->headingTypes;
        $options['default_heading_type'] = $this->defaultType;
        
        return $options;
    }
    
    public function setHeadingType($types = [])
    {
        $this->headingTypes = $types;
        
        return $this;
    }
    
    public function getHeadingType()
    {
        return $this->headingTypes;
    }
    
    public function setDefaultHeadingType($default)
    {
        $this->defaultType = $default;
        
        return $this;
    }
    
    public function getDefaultHeadingType()
    {
        return $this->defaultType;
    }
    
}