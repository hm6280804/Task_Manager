<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['user_id', 'name', 'slug', 'color', 'icon', 'description'];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
