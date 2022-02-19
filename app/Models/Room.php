<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'rname',
        'rkey',
        'description',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // add this function so you can retrieve number of checkins per room
    public function check_ins()
    {
        return $this->belongsToMany(CheckIn::class);
    }
}
