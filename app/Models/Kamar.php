<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    // protected $guarded = [];
    protected $fillable = [
        'nama_kamar',
        'no_kamar',
        'code_kamar',
        'harga',
        'maks_orang',
        'fasilitas_id',
        'tipe_kamar_id',
        'status',
        'gambar'
    ];
    public function tipe_kamar(){ 
        return $this->belongsTo(TipeKamar::class); 
    }
    public function reservasi(){ 
        return $this->hasMany(Reservasi::class,'kamar_id'); 
    }
    
}
