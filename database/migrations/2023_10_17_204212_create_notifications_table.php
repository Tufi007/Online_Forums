<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Recipient's user ID
        $table->unsignedBigInteger('sender_id'); // User who caused the action
        $table->unsignedBigInteger('notifiable_id'); // ID of the related model (question, answer, or comment)
        $table->string('notifiable_type'); // Type of the related model ('question', 'answer', 'comment')
        $table->text('data'); // Notification content
        $table->timestamp('read_at')->nullable(); // Timestamp when the notification was read
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('sender_id')->references('id')->on('users');
        $table->foreign('notifiable_id')->references('id')->on('questions');
    });
}


    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
