<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_absensi
 * @property integer $id_siswa
 * @property string $status_kehadiran
 * @property string $created_at
 * @property string $updated_at
 * @property Absensi $absensi
 * @property Siswa $siswa
 */
class DetilAbsensi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'detil_absensi';

    /**
     * @var array
     */
    protected $fillable = ['id_absensi', 'id_siswa', 'status_kehadiran', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function absensi()
    {
        return $this->belongsTo('App\Models\Absensi', 'id_absensi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'id_siswa');
    }
}
