<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class pinjam extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='pinjams';
    protected $primaryKey='id';
    protected $fillable=[
        'id',
        'alatlab_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(user::class);
    }
    public function alatlab(): BelongsTo{
        return $this->belongsTo(alatlab::class);
    }
}
