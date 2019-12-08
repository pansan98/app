<?php
namespace App\Http\Library\File\Factory;

class Factory {
    
    protected $file_name;
    
    protected $file_original_name;
    
    protected $file_type;
    
    protected $file_size;
    
    protected $file_tmp_name;
    
    protected $file_extension;
    
    protected $file_width;
    
    protected $file_height;
    
    protected $file_error;
    
    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->file_name;
    }
    
    public function getFileOriginalName()
    {
        return $this->file_original_name;
    }
    
    public function setFileOriginalName($original_name)
    {
        $this->file_original_name = $original_name;
        
        return $this;
    }
    
    /**
     * @param $fileType
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->file_type = $fileType;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->file_type;
    }
    
    /**
     * @param $fileSize
     * @return $this
     */
    public function setFileSize($fileSize)
    {
        $this->file_size = $fileSize;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->file_size;
    }
    
    /**
     * @param $fileTmpName
     * @return $this
     */
    public function setFileTmpName($fileTmpName)
    {
        $this->file_tmp_name = $fileTmpName;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileTmpName()
    {
        return $this->file_tmp_name;
    }
    
    /**
     * @param $fileExtension
     * @return $this
     */
    public function setFileExtension($fileExtension)
    {
        $this->file_extension = $fileExtension;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileExtension()
    {
        return $this->file_extension;
    }
    
    /**
     * @return mixed
     */
    public function getFileWidth()
    {
        return $this->file_width;
    }
    
    /**
     * @param $width
     * @return $this
     */
    public function setFileWidth($width)
    {
        $this->file_width = $width;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileHeight()
    {
        return $this->file_height;
    }
    
    /**
     * @param $height
     * @return $this
     */
    public function setFileHeight($height)
    {
        $this->file_height = $height;
        
        return $this;
    }
    
    /**
     * @param $fileError
     * @return $this
     */
    public function setFileError($fileError)
    {
        $this->file_error = $fileError;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileError()
    {
        return $this->file_error;
    }
}
?>