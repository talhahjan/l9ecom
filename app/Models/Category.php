<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    
public function products(){
    return $this->belongsToMany('App\Models\Product', 'category_product');

}

public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

public function getRouteKeyName(){
    return 'slug';
}
}
