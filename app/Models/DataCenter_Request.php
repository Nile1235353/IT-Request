<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCenter_Request extends Model
{
    //
    protected $fillable = [
        'Requester_Name',
        'Employee_ID',
        'Requester_Phone',
        'Department',
        'Priority',
        'Issue_Category',
        'Request_Description',
        'Remark',
        'created_at',
        'updated_at'
    ];
}
