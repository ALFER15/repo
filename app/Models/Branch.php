<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    use HasFactory;

    //protected $fillable = [];
    protected $guarded = [];

    //relacion uno a muchos
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    //relacion muchos a muchos
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    //relacion muchos a muchos
    public function suppliers() {
        return $this->belongsToMany(Supplier::class);
    }

    //relacion uno a muchos
    public function users(){
        return $this->hasMany(User::class);
    }
}
