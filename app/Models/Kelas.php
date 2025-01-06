<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'jumlah',
    ];

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'kelas_id');
    }

    public function mahasiswa() 
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id');
    }

    public function request()
    {
        return $this->hasMany(UserRequest::class);
    }
}
