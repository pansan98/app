<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RelativeController;
use App\Http\Helper\MediaHelper;
use App\Http\Helper\MediaUploadHelper;

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
                $storage_files[filemtime($file).'_'.$k]['filetime'] = filemtime($file);
                $storage_files[filemtime($file).'_'.$k]['filename'] = str_replace($storage, '', $file);
            }
            
            krsort($storage_files);
        }
        
        $storage_path = config('const.root_relative') . 'storage/upload/';
        
        return view('storage/index', compact("storage_files", "storage_path"));
    }
    
    public function store(Request $request)
    {
        if(isset($request->file_name)) {
            $file_name = $request->file_name;
            $mediaUpload = new MediaUploadHelper();
    
            $id = $mediaUpload->loadFile($file_name);
        }
        
        return redirect('/client-storage');
    }
    
    public function destroy($filename)
    {
        $storage = storage_path() . '/upload/';
        
        MediaHelper::delete($storage . $filename);
        
        return redirect('/client-storage');
    }
}
