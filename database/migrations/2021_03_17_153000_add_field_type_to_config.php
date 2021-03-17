<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldTypeToConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_config', function (Blueprint $table) {
            $table->string('field_type')->default('\\\Bozboz\\\Admin\\\Fields\\\TextareaField');
        });
        DB::table('site_config')->where('alias', 'benner_message')->update(['field_type' => '\\\Bozboz\\\Admin\\\Fields\\\HTMLEditorField']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_config', function (Blueprint $table) {
            $table->dropColumn('field_type');
        });
    }
}
