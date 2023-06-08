<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'grade_id', 'status'];
    public $translatable = ['name'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function stage()
    {
        return $this->belongsToThrough(Stage::class, Grade::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'section_teacher');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }


}
