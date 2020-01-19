<?php

namespace App\Http\Helper;

use App\Http\Helper\MediaHelper;
use App\Media;

class MediaUploadHelper {
    
    /**
     * @param $file_name
     * @return null
     */
    public function loadFile($file_name)
    {
        $storage = storage_path() . '/upload/';
        $file_path = $storage . $file_name;
        
        if(MediaHelper::isFile($file_path)) {
            $toArray = [];
    
            list($toArray['width'], $toArray['height']) = getimagesize($file_path);
            $toArray['size'] = filesize($file_path);
            $finfo = finfo_open(\FILEINFO_MIME_TYPE);
            $toArray['mime_type'] = finfo_file($finfo, $file_path);
            $toArray['extension'] = MediaHelper::getExtension($file_path);
            $toArray['directory'] = MediaHelper::getFileDirectoryFromMimeType($toArray['mime_type']);
            $toArray['file_name'] = $file_name;
            
            $toArray['name'] = 'No Title';
            $toArray['original_name'] = 'No Title';
            
            $mediaId = $this->saveToMedia($toArray);
            
            if(!is_null($mediaId)) {
                if(MediaHelper::mediaUpload($toArray)) {
                    return $mediaId;
                }
            }
        }
        
        return null;
    }
    
    /**
     * @param $toArray
     * @return null
     */
    protected function saveToMedia($toArray)
    {
        if(!empty($toArray)) {
            $entityClass = Media::class;
            $entity = new $entityClass();
            
            foreach ($toArray as $key => $data) {
                $entity->{$key} = $data;
            }
    
            $dateTime = new \DateTime();
            if(is_null($entity->created_at)) {
                $entity->created_at = $dateTime->format('Y-m-d H:i:s');
            }
    
            if(is_null($entity->updated_at)) {
                $entity->updated_at = $dateTime->format('Y-m-d H:i:s');
            }
            
            $entity->save();
            
            return $entity->id;
        }
        
        return null;
        
    }
    
    protected function toMimeType($mime_type)
    {
//        if(strstr(';', $mime_type) !== false) {
//            //$clean_mime_type = preg_replace('/ [;*]$/')
//        }
    }
}