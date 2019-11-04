<?php

namespace App\Http\Component\BlockSetting;

use App\Http\Component\BlockForm\TextareaForm;

class TextAreaSetting extends BaseBlockSetting {
    public $class = TextAreaForm::class;
    
    public function setRows($rows)
    {
        $this->options['rows'] = $rows;
        return $this;
    }
}