<?php

namespace App\Http\Library\File;

use App\Http\Library\File\FileFactory\FileIsFactory;
use App\Http\Library\File\Factory\Factory;
use App\Http\Library\File\FileFactory\FileErrorFactory;
use App\Http\Library\File\FileFactory\ErrorFactory;
use Exception;

class FileClient {
    public static $instance;
    public static $_fileType = 'single';
    
    protected $_filePath;
    protected $_fileFactory;
    protected $_fileErrorFactory;
    
    protected $_errors;
    
    /**
     * FileClient constructor.
     */
    public function __construct()
    {
        if((string)self::$_fileType === 'single') {
            $this->_fileFactory = new FileIsFactory();
        } elseif((string)self::$_fileType === 'multi') {
            $this->_fileFactory = new FileIsFactory();
        }
        
        $this->_fileErrorFactory = new FileErrorFactory();
    }
    
    /**
     * @return FileClient
     */
    public static function getInstance()
    {
        if(!self::$instance instanceof FileClient) {
            self::$instance = new static();
        }
        
        return self::$instance;
    }
    
    /**
     * @param $type
     */
    public static function registerType($type = 'single')
    {
        self::$_fileType = $type;
    }
    
    /**
     * @param $attr
     * @return false|mixed|string
     * @throws Exception
     */
    public function registerClient($attr)
    {
        $ret = $this->_fileFactory->registerUploadFile($attr);
        if(!$this->_fileErrorFactory->getIsError()) {
            if($ret instanceof Factory) {
                $data = $this->_fileFactory->moveUpload($ret, $this->_fileFactory->getUploadFileDir());
                return $data;
            }
        }
        
        return $ret;
    }
    
    /**
     * @param $dir
     */
    public function setFileDirClient($dir)
    {
        $this->_fileFactory->setUploadFileDir($dir);
    }
    
    /**
     * @param $file
     * @param $key
     */
    public function setSingleFileClient($file, $key)
    {
        $this->_fileFactory->deleteCurrentFile($key);
        $this->_fileFactory->setFactory($file, $key);
    }
    
    /**
     * ファイル名から削除
     * @param $name
     */
    public function deleteCurrentFileNameClient($name)
    {
        $this->_fileFactory->deleteCurrentFileName($name);
    }
    
    public function setMultiFileClient($files, $key)
    {
        //TODO 未実装
    }
    
}
?>