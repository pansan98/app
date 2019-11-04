<?php

namespace App\Http\Form\Traits;

use App\Http\Component\BlockSetting;

trait BlockSettingTrait {
    
    /**
     * @param $name
     * @return App\Http\Component\BlockSetting\TextSetting
     */
    public static function TextSetting($name)
    {
        return new \App\Http\Component\BlockSetting\TextSetting($name);
    }
    
    public static function TextAreaSetting($name)
    {
        return new \App\Http\Component\BlockSetting\TextAreaSetting($name);
    }
    
    public static function HeadingSetting($name)
    {
        return new \App\Http\Component\BlockSetting\HeadingSetting($name);
    }
    
    public static function SingleImageSetting($name)
    {
        return new \App\Http\Component\BlockSetting\SingleImageSetting($name);
    }
}