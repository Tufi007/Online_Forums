<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('answer_text');
            $table->longText('image')->nullable();
            $table->timestamp('date_time')
            ->default(now())
            ->useCurrent();
            $table->string('reference_links', 255);
            $table->unsignedBigInteger('q_id');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('q_id');

            // Foreign keys (assuming 'users' and 'questions' as related tables)
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('q_id')->references('id')->on('questions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
