<?php
namespace App\Http\Library\File\FileFactory;

use App\Http\Library\File\Factory\FileFactory;
use App\Http\Library\File\Factory\Factory;
use App\Htpp\Library\File\FileInterface\FileClientInterface;
use \Exception;

class FileIsFactory extends FileFactory {
    
    /**
     * @param $attribute
     * @return false|mixed|string
     * @throws Exception
     */
    public function registerUploadFile($attribute)
    {
        if(isset($this->_fileObj[$attribute])) {
            $afterFile = $this->_errorObj->isFileSizeType($this->_fileObj[$attribute]);
            if(!$afterFile instanceof FileErrorFactory) {
                if(!$this->_errorObj->getIsError()) {
                    $tempRet = $this->_errorObj->isFileTemplate($this->_fileObj[$attribute]);
                    if($tempRet) {
                        $alreadyRet = $this->_errorObj->isAlreadyFile($this->_fileObj[$attribute], $this->getUploadFileDir());
                        if($alreadyRet) {
                            return $this->_fileObj[$attribute];
                            //return $this->moveUpload($this->_fileObj[$attribute], $this->getUploadFileDir());
                        }
                    }
                }
            }
        } else {
            return $this->getFactory($attribute);
        }
        
        return $this->getErrors();
    }
    
    /**
     * @param Factory $obj
     * @param $moveDir
     * @return false|string
     * @throws Exception
     */
    public function moveUpload(Factory $obj, $moveDir)
    {
        $temporary = $obj->getFileName();
        $fileName = time().'_'.$temporary.'.'.$obj->getFileExtension();
        
        // ファイル名更新
        $obj->setFileName($fileName);
        
        $sourcePath = $obj->getFileTmpName();
        $movePath = $moveDir.$fileName;
        if(!move_uploaded_file($sourcePath, $movePath)) {
            throw new Exception(
                'File upload failed. Please check the permissions.'
            );
        }
        
        return $obj;
        
//        $result = [
//            'name' => $fileName,
//            'size' => $obj->getFileSize(),
//            'error' => false,
//            'extension' => $obj->getFileExtension()
//        ];
//
//        return json_encode($result);
    }
}
?>