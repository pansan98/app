<?php

namespace App\Http\Helper;

class MediaHelper {
    public static $instance;
    
    public static $image_mime_types = ['image/gif', 'image/jpeg', 'image/png', 'image/svg+xml', 'image/tiff'];
    public static $file_mime_types = ['application/pdf', 'audio/acc', 'audio/midi', 'audio/x-midi', 'audio/mpeg', 'audio/ogg'];
    
    /**
     * ファイルアップロード
     *
     * @param $fileToArray
     * @return bool
     */
    public static function mediaUpload($fileToArray)
    {
        
        if(!empty($fileToArray)) {
            $storage_dir = config('const.root_dir') . 'storage/';
            
            if(self::isDirectory($storage_dir)) {
                $storage_dir = $storage_dir . 'upload/';
                
                if(self::isDirectory($storage_dir)) {
                    if(isset($fileToArray['mime_type']) && isset($fileToArray['file_name'])) {
                        $file_directory = self::getFileDirectoryFromMimeType($fileToArray['mime_type']);
        
                        if(!is_null($file_directory)) {
                            $storage_dir = $storage_dir . $file_directory . '/';
            
                            if(self::isDirectory($storage_dir)) {
                                $storage_file = storage_path() . '/upload/' . $fileToArray['file_name'];
                                $move_path = $storage_dir . $fileToArray['file_name'];
                
                                if(self::move($storage_file, $move_path)) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * @param $directory
     * @return bool
     */
    public static function isDirectory($directory)
    {
        if(!file_exists($directory)) {
            if(mkdir($directory, 0777)) {
                return true;
            }
            
            return false;
        }
        
        return true;
    }
    
    /**
     * @param $file_path
     * @return bool
     */
    public static function isFile($file_path)
    {
        return file_exists($file_path);
    }
    
    /**
     * @param $storage
     * @param $move_path
     * @return bool
     */
    public static function move($storage, $move_path)
    {
        if(self::isFile($storage)) {
            if(rename($storage, $move_path)) {
                if(self::isFile($move_path)) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * MIME-TYPEからディレクトリを取得する
     *
     * @param $mimeType
     * @return null|string
     */
    public static function getFileDirectoryFromMimeType($mimeType)
    {
        if(in_array($mimeType, self::$image_mime_types)) {
            return 'images';
        }
        
        if(in_array($mimeType, self::$file_mime_types)) {
            return 'file';
        }
        
        return null;
    }
    
    /**
     * ファイル名から拡張子を取得する
     *
     * @param $file
     * @return mixed|null
     */
    public static function getExtension($file)
    {
        if(is_string($file)) {
            if(strstr($file, '.') !== false) {
                $ex = explode('.', $file);
                return end($ex);
            }
        }
        
        return null;
    }
    
    /**
     * @param $file_path
     * @return bool
     */
    public static function delete($file_path)
    {
        if(self::isFile($file_path)) {
            if(unlink($file_path)) {
                return true;
            }
        }
        
        return false;
    }
}