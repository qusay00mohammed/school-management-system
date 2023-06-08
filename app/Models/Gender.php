<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $fillable = ['name'];
    public $translatable = ['name'];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'gender_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
