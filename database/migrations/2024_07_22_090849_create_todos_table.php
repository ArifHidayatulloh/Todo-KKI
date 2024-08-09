<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todo', function (Blueprint $table) {
            $table->id();
            $table->string('dep_code',10);
            $table->string('working_list',255);
            $table->string('pic', 10);
            $table->json('relatedpic')->nullable();
            $table->date('deadline');
            $table->integer('status');
            $table->date('complete_date')->nullable();
            $table->string('comment_dephead', 500);
            $table->string('update_pic',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo');
    }
};
