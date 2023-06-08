<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class TheParent extends Authenticatable
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'parents';

    public $translatable = ['father_name','father_job','mother_name','mother_job'];
    protected $guarded = [];


    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function fileAttachments()
    {
        return $this->morphMany(FileAttachment::class, 'fileable', 'fileable_type', 'fileable_id', 'id');
    }


}
