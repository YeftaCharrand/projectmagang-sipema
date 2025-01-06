<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $fillable = [
        'user_id',
        'kelas_id',
        'kode_dosen',
        'nip',
        'name'
    ];

    // Definisikan relasi jika ada (misalnya dengan User dan Kelas)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   // Relasi dengan model Kelas
   public function kelas()
   {
       return $this->belongsTo(Kelas::class, 'kelas_id');
   }
}
