<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    //protected $fillable = [];
    protected $guarded = [];

    //Relacion muchos a muchos
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    //Relacion uno a uno
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    //relacion uno a mucho inversa
    public function client() {
        return $this->belongsTo(Client::class);
    }

    //Relacion uno a muchos inversa
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    //relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
}
