<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nama
 * @property string $kode
 * @property string $created_at
 * @property string $updated_at
 * @property Jadwal[] $jadwals
 * @property Siswa[] $siswas
 */
class Kelas extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nama', 'kode', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'id_kelas');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siswa()
    {
        return $this->hasMany('App\Models\Siswa', 'id_kelas');
    }
}
