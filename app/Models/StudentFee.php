<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;


    protected $filable = ['date', 'type', 'fee_invoice_id', 'catch_receipt_id', 'student_id', 'debit', 'credit', 'note'];


}
