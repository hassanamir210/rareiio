<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //Status Constants
    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';
    const USER_ADMIN     = 'admin';
    const USER_APPLICANT = 'applicant';
    
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'roleId',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->hasOne(Roles::class,'id','roleId');
    }

    /**
     * @return mixed
     */
    public function applicant()
    {
        return $this->hasOne(Applicant::class,'userId','id');
    }
    

    public function isAdmin(){
        if($this->role->label == self::USER_ADMIN)
            return true;

        return false;
    }

    public function isApplicant(){
        if($this->role->label == self::USER_APPLICANT)
            return true;

        return false;
    }

    public static function loginUser($id,$token,$message = '') 
    {
        // Find User For Provided Email
        $model = Self::where(['id' => $id])->first();

        return $token;
    }
    
    public function getArrayResponse() {
        return [
            'id'            => $this->id,
            'email'         => $this->email,
            'roles' => [
                'id'        => $this->roleId,    
                'label'     => $this->role->label,
            ],
        ];
    }
}
