<?php

namespace App\Http\Form\Media;

use App\Http\Form\BaseForm;
use App\Media;
use Illuminate\Foundation\Testing\Constraints;

class Form extends BaseForm {
    
    protected $name = 'メディアライブラリ';
    protected $action_name = 'media';
    
    protected function register()
    {
        $register = parent::register();
        
        $register->registerBlock(
            self::TextSetting('name')
                ->setFormName('画像名')
                ->enableRequired()
        );

        $register->registerBlock(
            self::MediaImageSetting('image')
                ->setFormName('画像')
        );

    }
}