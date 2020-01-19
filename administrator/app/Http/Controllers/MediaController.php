<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use App\Http\Controllers\RelativeController;
use App\Media;
use App\Http\Form\Media\Form;
use App\Http\Helper\MediaHelper;

class MediaController extends RelativeController
{
    protected $entityClass = Media::class;
    protected $formSetting = Form::class;
    protected $name = 'media';
    
    public function index()
    {
        $entities = $this->entityClass::enableBaseOrderBy()->get();
        
        $blocks = new $this->formSetting();
        $base_name = $blocks->getName();
        
        $storage_path = config('const.root_path') . 'storage/upload/';
        
        return view('media/index', compact("entities", "base_name", "storage_path"));
    }
    
    public function create()
    {
        return parent::create();
    }
    
    public function store(MediaRequest $request)
    {
        $entity = new $this->entityClass();
        $setting = new $this->formSetting();
        $blockList = array_keys($setting->getRegisterSettings());
        foreach ($blockList as $blockName) {
            // ファイル系は配列
            if(is_array($request->{$blockName})) {
                foreach ($request->{$blockName} as $toArray) {
                    
                    if(isset($toArray['name'])) {
                        unset($toArray['name']);
                    }
                    
                    foreach ($toArray as $request_key => $value) {
                        $entity->{$request_key} = $value;
                    }
                    
                    MediaHelper::mediaUpload($toArray);
                }
            } else {
                $entity->{$blockName} = $request->{$blockName};
            }
        }
        
        $dateTime = new \DateTime();
        if(is_null($entity->created_at)) {
            $entity->created_at = $dateTime->format('Y-m-d H:i:s');
        }
        
        if(is_null($entity->updated_at)) {
            $entity->updated_at = $dateTime->format('Y-m-d H:i:s');
        }
        
        $entity->save();
        
        return redirect('/' . $this->name);
    }
    
    public function destroy($id)
    {
        $entity = $this->entityClass::findOrFail($id);
        
        $upload_storage = config('const.root_dir') . 'storage/upload/' . $entity->directory . '/';
        $file_name = $entity->file_name;
        $file_path = $upload_storage . $file_name;
        
        MediaHelper::delete($file_path);
        
        $entity->delete();
        
        return redirect('/' . $this->name);
    }
}
