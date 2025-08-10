<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_jadwal
 * @property integer $id_guru
 * @property string $tanggal
 * @property string $pokok_pembahasan
 * @property string $koordinat
 * @property string $ip
 * @property string $created_at
 * @property string $updated_at
 * @property Staf $staf
 * @property Jadwal $jadwal
 * @property DetilAbsensi[] $detilAbsensis
 */
class Absensi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'absensi';

    /**
     * @var array
     */
    protected $fillable = ['id_jadwal', 'id_guru', 'tanggal', 'pokok_pembahasan', 'koordinat', 'ip', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staf()
    {
        return $this->belongsTo('App\Models\Staf', 'id_guru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal()
    {
        return $this->belongsTo('App\Models\Jadwal', 'id_jadwal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detilAbsensi()
    {
        return $this->hasMany('App\Models\DetilAbsensi', 'id_absensi');
    }
}
