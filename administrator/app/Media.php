<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $name;
    
    protected $original_name;
    
    protected $extension;
    
    protected $mime_type;
    
    protected $width;
    
    protected $height;
    
    protected $size;
    
    protected $created_at;
    
    protected $updated_at;
    
    
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
    
}
