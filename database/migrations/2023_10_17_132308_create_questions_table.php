
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 255);
            $table->text('description');
            $table->longText('image')->collation('utf8mb4_bin')->nullable();
            $table->timestamp('date_time')
            ->default(now())
            ->useCurrent();
            $table->unsignedBigInteger('s_id')->index();
            $table->foreign('s_id')->references('id')->on('subjects');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_name');
    }
};
