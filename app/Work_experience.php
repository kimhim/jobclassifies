<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_experience extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'position', 'start_date','finish_date','employee_id'
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
