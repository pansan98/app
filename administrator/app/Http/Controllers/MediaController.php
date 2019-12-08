<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RelativeController;
use App\Media;
use App\Http\Form\Media\Form;

class MediaController extends RelativeController
{
    protected $entityClass = Media::class;
    protected $formSetting = Form::class;
    protected $name = 'media';
    
    public function index()
    {
        $data = $this->entityClass::get();
        
        $blocks = new $this->formSetting();
        $base_name = $blocks->getName();
        
        return view('media/index', compact("data", "base_name"));
    }
    
    public function create()
    {
        return parent::create();
    }
}
