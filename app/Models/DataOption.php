<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $entity
 * @property string $nama
 * @property string $created_at
 * @property string $updated_at
 */
class DataOption extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'data_option';

    /**
     * @var array
     */
    protected $fillable = ['entity', 'nama', 'created_at', 'updated_at'];
}
