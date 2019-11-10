<?php
namespace App\Http\Library\File\Factory;

use App\Http\Library\File\FileInterface\FileClientInterface;
use App\Http\Library\File\FileFactory\FileErrorFactory;
use App\Http\Library\File\Factory\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileFactory implements FileClientInterface {
    
    protected $_fileObj = [];
    protected $_uploadFileDir;
    
    protected $_errorObj;
    public $_errors = [];
    
    public function __construct()
    {
        $this->_errorObj = new FileErrorFactory;
    }
    
    /**
     * @param $file
     * @param $key
     * @return mixed|void
     */
    public function setFactory($file, $key)
    {
        if(!isset($this->_fileObj[$key])) {
            $this->_fileObj[$key] = array();
        }
        
        if(!$this->_fileObj[$key] instanceof Factory) {
            $this->_fileObj[$key] = new Factory();
        }
//        $uploadFile = new UploadedFile();
//        $uploadFile->getFile
        
        if(is_object($file[$key]) AND $file[$key] instanceof UploadedFile) {
            $this->_fileObj[$key]->setFileName($file[$key]->getFilename())->setFileType($file[$key]->getClientMimeType())->setFileSize($file[$key]->getClientSize())->setFileTmpName($file[$key]->getPathname())->setFileError($file[$key]->getError());
            $this->_fileObj[$key]->setFileExtension($file[$key]->getClientOriginalExtension());
        } else {
            $this->_fileObj[$key]->setFileName($file[$key]['name'])->setFileType($file[$key]['type'])->setFileSize($file[$key]['size'])->setFileTmpName($file[$key]['tmp_name'])->setFileError($file[$key]->getError());
            $this->_fileObj[$key]->setFileExtension(end(explode('.', $this->_fileObj[$key]->getFileName())));
        }
    }
    
    /**
     * @param $key
     * @return mixed
     */
    public function getFactory($key)
    {
        if(!$this->_fileObj[$key] instanceof Factory) {
            if(isset($this->_fileObj[$key]) AND !is_null($this->_fileObj[$key])) {
                unset($this->_fileObj[$key]);
            }
        }
        
        return $this->_fileObj[$key];
    }
    
    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_errorObj;
    }
    
    /**
     * @param $key
     * @return mixed
     */
    public function getError($key)
    {
        return $this->_errors[$key];
    }
    
    /**
     * @param $key
     * @return mixed|void
     */
    public function deleteCurrentFile($key)
    {
        if(isset($this->_fileObj[$key]) AND $this->_fileObj[$key] instanceof Factory) {
            $this->deleteFile($this->getUploadFileDir().$this->_fileObj[$key]->getFileName());
            unset($this->_fileObj[$key]);
        }
    }
    
    /**
     * @param $name
     */
    public function deleteCurrentFileName($name)
    {
        $this->deleteFile($this->getUploadFileDir() . $name);
    }
    
    /**
     * @param $dir
     * @return mixed|void
     */
    public function setUploadFileDir($dir)
    {
        $this->_uploadFileDir = $dir;
    }
    
    /**
     * @return mixed
     */
    public function getUploadFileDir()
    {
        return $this->_uploadFileDir;
    }
    
    /**
     * @param $fileDir
     */
    protected function deleteFile($fileDir)
    {
        if(file_exists($fileDir)) {
            @unlink($fileDir);
        }
    }
}
?>