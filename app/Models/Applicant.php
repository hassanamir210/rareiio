<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //Status Constants
    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applicants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phoneNumber',
        'dob',
        'coverLetterPath',
        'cvPath',
        'userId',
    ];


    public function getArrayResponse() {
        return [
            'id'            	=> $this->id,
            'name'         		=> $this->name,
            'phoneNumber'       => $this->phoneNumber,
            'dob'         		=> $this->dob,
            'coverLetterPath'   => $this->coverLetterPath,
            'cvPath'         	=> $this->cvPath,
            'userId'         	=> $this->userId,
        ];
    }
}
