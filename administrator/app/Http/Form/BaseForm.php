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
    
    public function getRegisterSettings()
    {
        $this->register();
        
        return $this->register->getRegisterBlocks();
    }
    
    public function renderBlocks()
    {
        $views = new Views();
        
        foreach ($this->loaded_form as $block) {
            echo $views->renderBlock($block->getTemplate(), compact("block"));
        }
    }
    
    public function loadForm($settings, $entity = null)
    {
        foreach ($settings as $name => $setting) {
            $formClass = $setting['class'];
            
            $loadForm = new $formClass($name, $setting['options']);
            $this->loadEntity($loadForm, $entity);
            
            $this->loaded_form[] = $loadForm;
        }
    }
    
    protected function loadEntity($loadForm, $entity)
    {
        if(!empty($entity)) {
            $loadForm->setValues($entity->{$loadForm->getName()});
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getActionName()
    {
        return $this->action_name;
    }
}
