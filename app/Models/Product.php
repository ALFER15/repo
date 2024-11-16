<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //protected $fillable = [];
    protected $guarded = [];

    //relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }
    //relacion uno a muchos inversa
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    //relacion muchos a muchos
    public function tickets(){
        return $this->belongsToMany(Ticket::class);
    }
    //relacion muchos a muchos
    public function branches(){
        return $this->belongsToMany(Branch::class);
    }
    
}
