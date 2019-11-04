<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $name;
    
    protected $price;
    
    protected $author;
    
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
    
    public function __toString()
    {
        return parent::__toString();
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
}
