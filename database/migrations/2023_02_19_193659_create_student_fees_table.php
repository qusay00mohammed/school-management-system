<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');

            $table->foreignId('fee_invoice_id')->nullable()->references('id')->on('fee_invoices')->onDelete('cascade');
            $table->foreignId('catch_receipt_id')->nullable()->references('id')->on('catch_receipts')->onDelete('cascade');
            $table->foreignId('processing_fee_id')->nullable()->references('id')->on('processing_fees')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipts')->onDelete('cascade');

            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_accounts');
    }
}
