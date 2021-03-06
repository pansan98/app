<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Book;
use App\Http\Form\Book\Form;
use App\Http\Controllers\RelativeController;

class BookController extends RelativeController
{
    protected $entityClass = Book::class;
    protected $formSetting = Form::class;
    protected $name = 'book';
    
    public function index()
    {
        // DBから値をすべて取得する
        $books = $this->entityClass::enableBaseOrderBy()
            ->get();
        
        $blocks = new $this->formSetting();
        $base_name = $blocks->getName();
        
        $columns = $this->getListTableOptions();
        
        // レンダリング
        return view('base/index', compact("books", "columns", "base_name"));
    }
    
    public function create()
    {
        return parent::create();
    }
    
    public function store(BookRequest $request)
    {
        $entity = new $this->entityClass();
        $setting = new $this->formSetting();
        $blockList = array_keys($setting->getRegisterSettings());
        foreach ($blockList as $blockName) {
            $entity->{$blockName} = $request->{$blockName};
        }
        $entity->save();
    
        return redirect('/' . $this->name);
    }
    
    public function edit($id)
    {
        $entity = $this->entityClass::findOrFail($id);
        $blocks = new $this->formSetting();
        $blocks->loadForm($blocks->getRegisterSettings(), $entity);
        $base_name = $blocks->getName();
        
        $action = $this->createFormAction($id);
        $status = 'edit';
        
        // レンダリング
        return view('base/create', compact("blocks", "base_name", "action", "status"));
    }
    
    public function update(BookRequest $request, $id)
    {
        $entity = $this->entityClass::findOrFail($id);
        $setting = new $this->formSetting();
        $blockList = array_keys($setting->getRegisterSettings());
        foreach ($blockList as $blockName) {
            $entity->{$blockName} = $request->{$blockName};
        }
        
        $entity->save();
    
        return redirect('/' . $this->name);
    }
    
    protected function getListTableOptions($options = [])
    {
        $aoColumns = ['タイトル', '価格', '著者'];
        
        $columns = parent::getListTableOptions($aoColumns);
        
        return $columns;
    }
    
}
