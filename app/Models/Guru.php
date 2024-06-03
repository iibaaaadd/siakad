<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'nip',
        'foto',
        'tempat',
        'tgl',
        'alamat',
        'email',
        'telepon',
        'jenis_kelamin',
    ];

    public function Jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
