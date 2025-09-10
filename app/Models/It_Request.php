<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class It_Request extends Model
{
    //
    protected $fillable = [
        'Requester_Name',
        'Employee_ID',
        'Requester_Phone',
        'Department',
        'Issue_Category',
        'Request_Description',
        'Remark',
        'created_at',
        'updated_at'
    ];
}
