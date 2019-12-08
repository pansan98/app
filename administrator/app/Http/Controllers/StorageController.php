<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RelativeController;

class StorageController extends RelativeController
{
    //
    public function index()
    {
        $storage = storage_path() . '/upload/';
        
        $storage_files = [];
        if(file_exists($storage)) {
            $storage_dir = glob($storage . '*');
    
            foreach ($storage_dir as $k => $file) {
                // Only file name
                $storage_files[$k]['filetime'] = filemtime($file);
                $storage_files[$k]['filename'] = str_replace($storage, '', $file);
            }
        }
        
        $storage_path = config('const.root_relative') . 'storage/upload/';
        
        return view('storage/index', compact("storage_files", "storage_path"));
    }
    
    public function destroy($filename)
    {
        $storage = storage_path() . '/upload/';
        
        if(file_exists($storage . $filename)) {
            @unlink($storage . $filename);
        }
        
        return redirect('/client-storage');
    }
}
