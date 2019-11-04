<?php

namespace App\Http\Component\BlockForm;

use App\Http\Component\BlockSetting\BaseBlockSetting;
use Illuminate\Foundation\Testing\Constraints;

class RegisterForm {
    protected $name;
    protected $params = [];
    protected $registerBlocks = [];
    
    public function getRegisterBlocksData($name)
    {
        return isset($this->registerBlocks[$name]) ? $this->registerBlocks[$name] : null;
    }
    
    public function registerBlock(BaseBlockSetting $blockSetting)
    {
        $name = $blockSetting->getName();
        $class = $blockSetting->getClass();
        $options = $blockSetting->getOptions();
        
        $this->add($name, $class, $options);
        
        return $this;
    }
    
    public function add($name, $class, $options = [])
    {
        $this->registerBlocks[$name] = [
            'class' => $class,
            'options' => $options
        ];
        
        return $this;
    }
    
    public function getRegisterBlocks()
    {
        return $this->registerBlocks;
    }
}