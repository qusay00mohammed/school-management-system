<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'fileable_id', 'fileable_type'];

    public function fileable()
    {
        return $this->morphTo();
    }

}
