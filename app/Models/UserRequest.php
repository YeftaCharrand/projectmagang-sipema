<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'request';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'kelas_id', 
        'mahasiswa_id',
        'keterangan'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
