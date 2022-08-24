<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
			$table->string('invoice_number')->unique();
			$table->date('invoice_date');
			$table->date('sale_date');
			$table->date('due_date');

			$table->enum('payment_method', [
				'cash','bank transfer', 'credit card'
			]);

			$table->foreignId('user_id')->nullable()
				->constrained()
				->cascadeOnUpdate()
				->nullOnDelete();
				
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
        Schema::dropIfExists('invoices');
    }
};
