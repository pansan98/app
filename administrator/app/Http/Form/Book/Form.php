<?php

namespace App\Http\Form\Book;

use App\Http\Form\BaseForm;
use App\Book;
use Illuminate\Foundation\Testing\Constraints;

class Form extends BaseForm {
    
    protected $name = '書籍';
    protected $action_name = 'book';
    
    protected function register()
    {
        $register = parent::register();
        
        $register->registerBlock(
            self::TextSetting('price')
                ->setFormName('料金')
                ->enableRequired()
        );
        
        $register->registerBlock(
            self::TextSetting('author')
                ->setFormName('著者')
                ->enableRequired()
        );

        $register->registerBlock(
            self::TextAreaSetting('comment')
                ->setRows(10)
                ->setFormName('説明文')
                ->enableRequired()
        );

        $register->registerBlock(
            self::HeadingSetting('heading')
                ->setFormName('見出し')
                ->setDefaultHeadingType('h3')
        );

        $register->registerBlock(
            self::SingleImageSetting('image')
                ->setFormName('サムネイル画像')
        );
    
        $register->registerBlock(
            self::SingleImageSetting('image_2')
                ->setFormName('サムネイル画像')
        );

    }
}