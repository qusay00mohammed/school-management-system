<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stage extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'notes'];
    public $translatable = ['name'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'stage_id');
    }

    public function sections()
    {
        return $this->hasManyThrough(Section::class, Grade::class);
    }

}
