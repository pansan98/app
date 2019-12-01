<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Library\File\FileClient;

class MultiImageController {
    protected $file_client;
    
    public function uploadMulti(Request $request)
    {
        FileClient::registerType('multi');
        $this->file_client = FileClient::getInstance();
        $this->file_client->setFileDirClient(storage_path() . '/upload/');
        
        
        $request_file = $request->files->get('files');
        $attr = $request->request->get('attr');
        
        $file = [];
        $file[$attr] = $request_file;
        $this->file_client->setFileClient($file, $attr);
        
        $files = $this->file_client->registerClient($attr);
        
        return response()->json(['file_obj' => $files]);
    }
    
    public function deleteMulti(Request $request)
    {
        $this->file_client = FileClient::getInstance();
        $this->file_client->setFileDirClient(storage_path() . '/upload/');
        
        $deleteFile = $request->request->get('file');
        
        $this->file_client->deleteCurrentFileNameClient($deleteFile);
        
        return response()->json(['status' => 200]);
    }
}