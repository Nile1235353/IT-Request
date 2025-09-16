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
        'Location',
        // 'Priority',
        'Issue_Category',
        'Request_Description',
        'Remark',
        'created_at',
        'updated_at',
        // 'is_fixed',
        // 'Fixed_Details',
    ];
}
