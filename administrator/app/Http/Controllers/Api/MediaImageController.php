<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Library\File\FileClient;
use App\Http\Views\Views;

class MediaImageController {
    protected $file_client;
    
    public function uploadMedia(Request $request)
    {
        FileClient::registerType('single');
        $this->file_client = FileClient::getInstance();
        $this->file_client->setFileDirClient(storage_path() . '/upload/');
        
        
        $request_file = $request->files->get('files');
        $attr = $request->request->get('attr');
        $number = $request->request->get('number');
        $number = (int)$number + 1;
        
        $file = [];
        $file[$attr] = $request_file;
        $this->file_client->setFileClient($file, $attr);
        
        $image_factory = $this->file_client->registerClient($attr);
        
        $views = new Views();
        $views->setTheme('api');
        
        $html = $views->renderBlock('media.blade.php', [
            'image_factory' => $image_factory,
            'attr' => $attr,
            'number' => $number
        ]);
        
        return response()->json([
            'html' => $html,
            'name' => $image_factory->getFileName(),
            'number' => $number
        ]);
    }
    
    public function deleteMedia(Request $request)
    {
        $this->file_client = FileClient::getInstance();
        $this->file_client->setFileDirClient(storage_path() . '/upload/');
        
        $deleteFile = $request->request->get('file');
        
        $this->file_client->deleteCurrentFileNameClient($deleteFile);
        
        return response()->json(['status' => 200]);
    }
}