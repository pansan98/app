<?php
namespace App\Http\Library\File\FileFactory;

use App\Http\Library\File\Factory\FileFactory;
use App\Http\Library\File\Factory\Factory;
use App\Htpp\Library\File\FileInterface\FileClientInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Exception;

class FileMultiFactory extends FileFactory {
    
    protected $factories = [];
    
    /**
     * @param $attribute
     * @return false|mixed|string
     * @throws Exception
     */
    public function registerUploadFile($attribute)
    {
        if(isset($this->_fileObj[$attribute]) AND !empty($this->_fileObj[$attribute])) {
            $fileFactories = [];
            foreach ($this->_fileObj as $k => $fileObj) {
                $afterFile = $this->_errorObj[$k]->isFileSizeType($fileObj);
                if(!$afterFile instanceof FileErrorFactory) {
                    if(!$this->_errorObj[$k]->getIsError()) {
                        $tempRet = $this->_errorObj[$k]->isFileTemplate($fileObj);
                        if($tempRet) {
                            $alreadyRet = $this->_errorObj[$k]->isAlreadyFile($fileObj, $this->getUploadFileDir());
                            if($alreadyRet) {
                                $fileFactories[$k] = $fileObj;
                                //return $this->_fileObj[$attribute];
                                //return $this->moveUpload($this->_fileObj[$attribute], $this->getUploadFileDir());
                            }
                        }
                    }
                }
            }
            
            return $fileFactories;
        } else {
            return $this->getFactory($attribute);
        }
        
        //return $this->getErrors();
    }
    
    /**
     * @param Factory $obj
     * @param $moveDir
     * @return false|string
     * @throws Exception
     */
    public function moveUpload(Factory $obj, $moveDir)
    {
        $temporary = md5($obj->getFileName());
        $fileName = time().'_'.$temporary.'.'.$obj->getFileExtension();
        $sourcePath = $obj->getFileTmpName();
        $movePath = $moveDir.$fileName;
        if(!move_uploaded_file($sourcePath, $movePath)) {
            throw new Exception(
                'File upload failed. Please check the permissions.'
            );
        }
        
        $result = [
            'name' => $fileName,
            'size' => $obj->getFileSize(),
            'error' => false,
            'extension' => $obj->getFileExtension()
        ];
        
        return json_encode($result);
    }
    
    /**
     * @param $key
     * @return mixed|void
     */
    public function deleteCurrentFile($key)
    {
        if(!empty($this->_fileObj[$key])) {
            foreach ($this->_fileObj[$key] as $k => $factory) {
                if(isset($factory) AND $factory instanceof Factory) {
                    $this->deleteFile($this->getUploadFileDir().$factory->getFileName());
                    unset($this->_fileObj[$key][$k]);
                }
            }
        }
    }
    
    /**
     * @param $files
     * @param $key
     * @return mixed|void
     */
    public function setFactory($files, $key)
    {
        if(!isset($this->_fileObj[$key])) {
            $this->_fileObj[$key] = array();
        }
        
        // discard once for single error object
        unset($this->_errorObj);
        
        foreach($files as $k => $file) {
            if(!$this->_fileObj[$key][$k] instanceof Factory) {
                $this->_fileObj[$key][$k] = new Factory();
            }
            
            $this->_errorObj[$k] = new FileErrorFactory;
            
            if(is_object($file) AND $file instanceof UploadedFile) {
                $this->_fileObj[$key]->setFileName($file->getFilename())->setFileType($file->getClientMimeType())->setFileSize($file->getClientSize())->setFileTmpName($file->getPathname())->setFileError($file->getError());
                $this->_fileObj[$key]->setFileExtension($file->getClientOriginalExtension());
            } else {
                $this->_fileObj[$key]->setFileName($file[$key]['name'])->setFileType($file[$key]['type'])->setFileSize($file[$key]['size'])->setFileTmpName($file[$key]['tmp_name'])->setFileError($file[$key]->getError());
                $this->_fileObj[$key]->setFileExtension(end(explode('.', $this->_fileObj[$key]->getFileName())));
            }
        }
    }
}
?>