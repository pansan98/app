<?php

namespace App\Http\Form;

use App\Http\Component\BlockSetting\BaseBlockSetting;
use App\Http\Component\BlockForm\RegisterForm as register;
use App\Http\Form\Traits\BlockSettingTrait;
use App\Http\Views\Views;

class BaseForm {
    
    use BlockSettingTrait;
    
    protected $register = null;
    protected $name = null;
    protected $action_name = null;
    protected $loaded_form = [];
    
    /**
     * フォームセッティング
     *
     * @return register
     */
    protected function register()
    {
        $this->register = new register();
        
        $this->register->registerBlock(
            self::TextSetting('name')
                ->setFormName('タイトル')
                ->enableRequired()
        );
        
        return $this->register;
    }
    
    /**
     * アクションのすべてのフォームセッティングを取得する
     *
     * @return array|null
     */
    public function getRegisterSettings()
    {
        $this->register();
        
        return $this->register->getRegisterBlocks();
    }
    
    /**
     * ブロックのレンダリング
     */
    public function renderBlocks()
    {
        $views = new Views();
        
        foreach ($this->loaded_form as $block) {
            echo $views->renderBlock($block->getTemplate(), compact("block"));
        }
    }
    
    /**
     * フォームのローディングを行う
     *
     * @param $settings
     * @param null $entity
     */
    public function loadForm($settings, $entity = null)
    {
        foreach ($settings as $name => $setting) {
            $formClass = $setting['class'];
            
            $loadForm = new $formClass($name, $setting['options']);
            $this->loadEntity($loadForm, $entity);
            
            $this->loaded_form[] = $loadForm;
        }
    }
    
    /**
     * データの読み込み
     *
     * @param $loadForm
     * @param $entity
     */
    protected function loadEntity($loadForm, $entity)
    {
        if(!empty($entity)) {
            $loadForm->setValues($entity->{$loadForm->getName()});
        }
    }
    
    /**
     * フォーム名を取得する
     *
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * アクション名を取得する
     *
     * @return null
     */
    public function getActionName()
    {
        return $this->action_name;
    }
}
