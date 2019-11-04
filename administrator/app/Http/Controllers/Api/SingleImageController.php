<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Library\File\FileClient;

class SingleImageController {
    protected $file_client;
    
    public function uploadSingle(Request $request)
    {
        FileClient::registerType('single');
        $this->file_client = FileClient::getInstance();
        $this->file_client->setFileDirClient(storage_path() . '/upload/');
        
        
        $request_file = $request->request->get('files');
        $attr = $request->request->get('attr');
        
        $file = [];
        $file[$attr] = $request_file[0];
        $this->file_client->setSingleFileClient($file, $attr);
        
        $ret = $this->file_client->registerClient($attr);
        
        return response()->json(['file_obj' => $ret]);
    }
}