<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenameAddressToAlternatePhoneNumberInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add the new column
        Schema::table('users', function (Blueprint $table) {
            $table->string('alternate_phone_number')->nullable()->after('address');
        });

        // Copy data from the old column to the new column
        DB::table('users')->update(['alternate_phone_number' => DB::raw('address')]);

        // Remove the old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add the old column back
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('alternate_phone_number');
        });

        // Copy data from the new column back to the old column (if needed)
        DB::table('users')->update(['address' => DB::raw('alternate_phone_number')]);

        // Remove the new column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('alternate_phone_number');
        });
    }
}
