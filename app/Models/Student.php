<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name'];

    protected $fillable = ['name', 'email', 'password', 'academic_year', 'date_birthday', 'gender_id', 'nationality_id', 'bloodType_id', 'section_id', 'parent_id'];

    public function fileAttachments()
    {
        return $this->morphMany(FileAttachment::class, 'fileable', 'fileable_type', 'fileable_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function parent()
    {
        return $this->belongsTo(TheParent::class);
    }

    public function studentFee()
    {
        return $this->hasMany(StudentFee::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }





}
