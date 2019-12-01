<?php

namespace App\Http\Component\BlockSetting;

class BaseBlockSetting {
    
    protected $name;
    protected $class;
    protected $options;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->options = [
            'params' => []
        ];
        
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setFormName($name)
    {
        $this->options['form_name'] = $name;
        return $this;
    }
    
    public function setConstraints($constraints)
    {
        $this->options['constraints'][] = $constraints;
        return $this;
    }
    
    public function enableRequired()
    {
        $this->options['required'] = true;
        return $this;
    }
    
    public function setBlockClass($blockClass)
    {
        $this->options['block_class'] = $blockClass;
        return $this;
    }
    
    public function setValues($value)
    {
        $this->options['values'] = $value;
        return $this;
    }
    
    public function setFormTemplate($formTemplate)
    {
        $this->options['form_template'] = $formTemplate;
        
        return $this;
    }
    
    public function setContentTemplate($contentTemplate)
    {
        $this->options['content_template'] = $contentTemplate;
        
        return $this;
    }
}