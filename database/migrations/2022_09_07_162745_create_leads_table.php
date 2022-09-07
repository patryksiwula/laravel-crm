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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->text('description')->nullable();
			$table->decimal('lead_value');
			$table->enum('stage', ['new', 'negotiation', 'won', 'lost']);
			$table->string('source');

			$table->foreignId('user_id')->nullable()
				->constrained()
				->cascadeOnUpdate()
				->nullOnDelete();

			$table->morphs('client');
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
        Schema::dropIfExists('leads');
    }
};
