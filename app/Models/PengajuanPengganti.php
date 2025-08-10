<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_jadwal
 * @property integer $id_guru
 * @property integer $id_guru_pengganti
 * @property string $tanggal
 * @property string $alasan
 * @property string $created_at
 * @property string $updated_at
 * @property Staf $staf
 * @property Jadwal $jadwal
 * @property Staf $staf
 */
class PengajuanPengganti extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pengajuan_pengganti';

    /**
     * @var array
     */
    protected $fillable = ['id_jadwal', 'id_guru', 'id_guru_pengganti', 'tanggal', 'alasan', 'created_at', 'updated_at'];

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
    public function jadwal()
    {
        return $this->belongsTo('App\Models\Jadwal', 'id_jadwal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guruPengganti()
    {
        return $this->belongsTo('App\Models\Staf', 'id_guru_pengganti');
    }
}
