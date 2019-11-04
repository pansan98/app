<?php

namespace App\Http\Component\BlockSetting;

use App\Http\Component\BlockForm\HeadingForm;

class HeadingSetting extends BaseBlockSetting {
    public $class = HeadingForm::class;
    
    public function setDefaultHeadingType($default)
    {
        $this->options['default_heading_type'] = $default;
        
        return $this;
    }
    
    public function setHeadingTypes(array $headingTypes)
    {
        $this->options['heading_types'] = $headingTypes;
        
        return $this;
    }
}