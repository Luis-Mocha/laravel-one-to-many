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
        Schema::table('projects', function (Blueprint $table) {

            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // specifico la relazione
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
            // 'onDelete' è obbligatorio nelle relazioni
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {

            // prima elimino la relazione e poi la colonna
            $table->dropForeign('projects_type_id_foreign');
            $table->dropColumn('type_id');

        });
    }
};
