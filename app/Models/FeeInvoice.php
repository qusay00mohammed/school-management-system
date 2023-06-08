<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;

    protected $filable = ['invoice_date', 'student_id', 'grade_id', 'fee_id', 'amount', 'note'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
