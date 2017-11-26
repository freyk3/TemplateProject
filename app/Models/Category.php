<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Category extends Model
{
    protected $table = 'categories';

    public function items()
    {
        return $this->hasMany('Models/Item', 'category', 'slug');
    }
}
