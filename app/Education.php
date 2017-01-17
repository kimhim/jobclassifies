<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school', 'major', 'start_year','finish_year','employee_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    		'remember_token',
    ];
}
