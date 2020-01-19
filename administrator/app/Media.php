<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $id;
    
    /**
     * file_title
     *
     * @var
     */
    protected $name;
    
    /**
     * client_name
     *
     * @var
     */
    protected $original_name;
    
    protected $file_name;
    
    protected $extension;
    
    protected $mime_type;
    
    protected $width;
    
    protected $height;
    
    protected $size;
    
    protected $directory;
    
    protected $created_at;
    
    protected $updated_at;
    
    public static function enableBaseOrderBy($orders = [])
    {
        $model = self::orderBy('id', 'DESC');
        
        if(!empty($orders)) {
            foreach ($orders as $column => $order) {
                $model->addOrderBy($column, $order);
            }
        }
        
        return $model;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function getOriginalName()
    {
        return $this->original_name;
    }
    
    public function getExtension()
    {
        return $this->extension;
    }
    
    public function getFileName()
    {
        return $this->file_name;
    }
    
    public function getMimeType()
    {
        return $this->mime_type;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function getDirectory()
    {
        return $this->directory;
    }
    
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
}
