<?php

namespace App\Http\Component\BlockForm;

use App\Http\Component\BlockSetting\BaseBlockSetting;
use Illuminate\Foundation\Testing\Constraints;

class RegisterForm {
    protected $name;
    protected $params = [];
    protected $registerBlocks = [];
    
    /**
     * キー名のブロックを取得する
     *
     * @param $name
     * @return mixed|null
     */
    public function getRegisterBlocksData($name)
    {
        return isset($this->registerBlocks[$name]) ? $this->registerBlocks[$name] : null;
    }
    
    /**
     * ブロックセッティング
     *
     * @param BaseBlockSetting $blockSetting
     * @return $this
     */
    public function registerBlock(BaseBlockSetting $blockSetting)
    {
        $name = $blockSetting->getName();
        $class = $blockSetting->getClass();
        $options = $blockSetting->getOptions();
        
        $this->add($name, $class, $options);
        
        return $this;
    }
    
    /**
     * ブロックの追加
     *
     * @param $name
     * @param $class
     * @param array $options
     * @return $this
     */
    public function add($name, $class, $options = [])
    {
        $this->registerBlocks[$name] = [
            'class' => $class,
            'options' => $options
        ];
        
        return $this;
    }
    
    /**
     * セッティングしたすべてのブロックを取得する
     *
     * @return array
     */
    public function getRegisterBlocks()
    {
        return $this->registerBlocks;
    }
}