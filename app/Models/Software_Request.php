<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software_Request extends Model
{
    //
    use HasFactory;

    protected $table = 'software_requests'; // ✅ double underscore မဟုတ်စေပါနဲ့

    protected $fillable = [
        'ticket_id',
        'requester_name',
        'employee_id',
        'requester_email',
        'requester_phone',
        'department',
        'location',
        'request_date',
        'priority',
        'system',
        'type',
        'issue_category',
        'other_category',
        'request_description',
        'assignee',
        'software_comment',
        'testers',
        'status',
        'launched_date',
        'job_done_date',
        'user_feedback',
        'remark',
    ];
}
