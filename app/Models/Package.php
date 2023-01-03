<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Package extends Model
{
    use HasFactory;
    
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
