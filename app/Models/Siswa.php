<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_kelas
 * @property string $nama_lengkap
 * @property string $nama_panggilan
 * @property string $nis
 * @property string $created_at
 * @property string $updated_at
 * @property DetilAbsensi[] $detilAbsensis
 * @property Kela $kela
 */
class Siswa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'siswa';

    /**
     * @var array
     */
    protected $fillable = ['id_kelas', 'nama_lengkap', 'nama_panggilan', 'nis', 'noHP', 'created_at', 'updated_at', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detilAbsensi()
    {
        return $this->hasMany('App\Models\DetilAbsensi', 'id_siswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }
}
