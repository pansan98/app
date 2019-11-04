<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Capture;
use JonnyW\PhantomJs\Client;

class CaptureController extends Controller
{
    protected $entityClass = Capture::class;
    
    public function index()
    {
        $captures = $this->entityClass::orderBy('id', 'DESC')
            ->get();
        
        $columns = $this->getListTableOptions();
        
        return view('capture/index', compact("captures", "columns"));
    }
    
    public function create()
    {
        $capture = new $this->entityClass();
        
        return view('capture/create', compact("capture"));
    }
}
