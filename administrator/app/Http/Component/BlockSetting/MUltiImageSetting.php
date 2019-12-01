<?php

namespace App\Http\Component\BlockSetting;

use App\Http\Component\BlockForm\MultiImageForm;

class MultiImageSetting extends BaseBlockSetting {
    public $class = MultiImageForm::class;
    
    public function setMaxItems($max)
    {
        $this->options['max_items'] = $max;
        
        return $this;
    }
    
    public function setMaxCapacity($capacity)
    {
        $this->options['max_capacity'] = $capacity;
        
        return $this;
    }
}