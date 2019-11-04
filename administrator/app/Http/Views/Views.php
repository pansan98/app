<?php

namespace App\Http\Views;

use Illuminate\Support\Facades\Config;

class Views {
    protected $template;
    protected $block_template;
    protected $theme = 'default';
    
    public function renderBlock($template, $data)
    {
        extract($data);
        ob_start();
        include config('const.admin_root_dir') . 'app/Http/Resources/BlockTemplate/form-block/'.$this->getTheme().'/'.$template;
        $render = ob_get_contents();
        ob_end_clean();
        return $render;
    }
    
    public function renderFrontBlock($template, $data)
    {
        extract($data);
        ob_start();
        include config('const.admin_root_dir') . 'app/Http/Resources/BlockTemplate/content-block/'.$this->getTheme().'/'.$template;
        $render = ob_get_contents();
        ob_end_clean();
        return $render;
    }
    
    public function getTheme()
    {
        return $this->theme;
    }
    
    public function setTheme($theme)
    {
        $this->theme = $theme;
        
        return $this;
    }
}