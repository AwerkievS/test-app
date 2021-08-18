<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('clients', function (Blueprint $table) {
            $table->index('name');
            $table->index('last_name');
        });

        Schema::table('client_phones', function (Blueprint $table) {
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
        });

        Schema::table('client_emails', function (Blueprint $table) {
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex('users_name_index');
            $table->dropIndex('users_last_name_index');
        });

        Schema::table('client_phones', function (Blueprint $table) {
            $table->dropForeign('client_phones_client_id_foreign');
        });

        Schema::table('client_emails', function (Blueprint $table) {
            $table->dropForeign('client_emails_client_id_foreign');
        });
    }
}
