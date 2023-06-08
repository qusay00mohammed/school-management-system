<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name', 'amount', 'grade_id', 'note', 'academic_year', 'fee_type'];

    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}
