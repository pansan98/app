<?php

namespace App\Http\Component\BlockForm;

class MultiImageForm extends BaseBlockForm {
    protected $type = 'image';
    
    public $template = 'multi-image.blade.php';
    public $constraints = [];
    public $formName = '複数画像ファイル';
    
    public $maxItems = 1;
    public $maxCapacity = 3;
    
    
    public function formInit($options)
    {
        parent::formInit($options);
        
        $this->setMaxItems($options['max_items']);
        $this->setMaxCapacity($options['max_capacity']);
    }
    
    public function filterDefaultOptions($options)
    {
        $options['max_items'] = $this->maxItems;
        $options['max_capacity'] = $this->maxCapacity;
        
        return $options;
    }
    
    public function setMaxItems($items)
    {
        $this->maxItems = $items;
        
        return $this;
    }
    
    public function getMaxItems()
    {
        return $this->maxItems;
    }
    
    public function setMaxCapacity($capacity)
    {
        $this->maxCapacity = $capacity;
        
        return $this;
    }
    
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }
}