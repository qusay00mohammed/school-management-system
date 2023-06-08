<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    use HasFactory;
    protected $fillable = ['integration', 'section_id', 'created_by', 'meeting_id', 'topic', 'start_at', 'duration', 'password', 'start_url', 'join_url'];


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }


}
