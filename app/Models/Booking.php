<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $with = ['place','vehicle','package'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function place(){
        return $this->belongsTo(Place::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
