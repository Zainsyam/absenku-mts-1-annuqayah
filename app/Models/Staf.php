<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_jabatan
 * @property string $nama_lengkap
 * @property string $nama_panggilan
 * @property string $rate_gaji
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Absensi[] $absensis
 * @property Jadwal[] $jadwals
 * @property PengajuanPengganti[] $pengajuanPenggantis
 * @property PengajuanPengganti[] $pengajuanPenggantis
 * @property Jabatan $jabatan
 */
class Staf extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'staf';

    /**
     * @var array
     */
    protected $fillable = ['id_jabatan', 'nama_lengkap', 'nama_panggilan', 'rate_gaji', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi()
    {
        return $this->hasMany('App\Models\Absensi', 'id_guru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'id_guru');
    }

    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'id_jabatan');
    }
}
