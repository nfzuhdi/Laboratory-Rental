<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class alatlab extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='alatlabs';
    protected $primaryKey='id';
    protected $fillable=[
        'id',
        'kategori_id',
        'nama_alat',
        'merek',
        'kode',
        'jumlah'
    ];
    
    public function kategori():BelongsTo{
        return $this->belongsTo(kategori::class);
    }
}
