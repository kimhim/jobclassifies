<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_title', 'job_description', 'job_requirement','job_categories','job_closing_date','job_priority','company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
