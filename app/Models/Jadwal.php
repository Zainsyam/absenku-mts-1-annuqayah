<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_guru
 * @property integer $id_mata_pelajaran
 * @property integer $id_kelas
 * @property string $hari
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $jenis
 * @property string $created_at
 * @property string $updated_at
 * @property Absensi[] $absensis
 * @property Staf $staf
 * @property MataPelajaran $mataPelajaran
 * @property Kela $kela
 * @property PengajuanPengganti[] $pengajuanPenggantis
 */
class Jadwal extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'jadwal';

    /**
     * @var array
     */
    protected $fillable = ['id_guru', 'id_mata_pelajaran', 'id_kelas', 'hari', 'jam_mulai', 'jam_selesai', 'jenis', 'status_pengganti'. 'status_guru_pengganti', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi()
    {
        return $this->hasMany('App\Models\Absensi', 'id_jadwal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Staf', 'id_guru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mataPelajaran()
    {
        return $this->belongsTo('App\Models\MataPelajaran', 'id_mata_pelajaran');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengajuanPengganti()
    {
        return $this->hasMany('App\Models\PengajuanPengganti', 'id_jadwal');
    }
}
