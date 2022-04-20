<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservasi';
    protected $guarded = [];
    public function kamar(){ 
        return $this->belongsTo(Kamar::class,'kamar_id'); 
    }
}
