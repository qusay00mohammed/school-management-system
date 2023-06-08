<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'stage_id'];
    public $translatable = ['name'];

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'grade_id');
    }
}
