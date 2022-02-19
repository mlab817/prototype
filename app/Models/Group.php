<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// comment: why this? what's member1, member_n, are these users too?
class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_name',
        'member1',
        'member2',
        'member3',
        'member4',
        'section',
    ];
}
