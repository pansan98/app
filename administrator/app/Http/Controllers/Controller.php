<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $entityClass;
    protected $formSetting;
    protected $name = null;
    protected $defaultColumns = ['タイトル'];
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function getListTableOptions($aoColumns = [])
    {
        if(empty($aoColumns)) {
            $aoColumns = $this->defaultColumns;
        }
        
        array_unshift($aoColumns, '編集');
        $aoColumns[] = '削除';
        
        return $aoColumns;
    }
    
    public function create()
    {
        $blocks = new $this->formSetting();
        $base_name = $blocks->getName();
        $blocks->loadForm($blocks->getRegisterSettings());
        
        $action = $this->createFormAction();
        $status = 'create';
        
        return view('base/create', compact("blocks", "base_name", "action", "status"));
    }
    
    protected function getSortTableOptions($aoColumns = [])
    {
    }
    
//    public function store($request)
//    {
//        $entity = new $this->entityClass();
//        $setting = new $this->formSetting();
//        $blockList = array_keys($setting->getRegisterSettings());
//        foreach ($blockList as $blockName) {
//            $entity->{$blockName} = $request->{$blockName};
//        }
//        $entity->save();
//
//        return redirect('/' . $this->name);
//    }
    
    public function destroy($id)
    {
        $entity = $this->entityClass::findOrFail($id);
        $entity->delete();
        
        return redirect('/' . $this->name);
    }
    
    protected function createFormAction($id = null)
    {
        $actionPath = config('const.admin_root_path') . $this->name;
        
        if(!is_null($id) AND is_numeric($id)) {
            $actionPath .= '/'.$id;
        }
        
        return $actionPath;
    }
}
