<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description','label'];

    public static function findByAttr($attr,$label){
        $model = self::where($attr,'=',$label)->first();
        if(!empty($model))
            return $model;

        return '';
    }
}
