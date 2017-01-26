<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteConfigConfigTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_config_values_tags', function (Blueprint $table) {
            $table->unsignedInteger('config_value_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();

            $table->primary(['config_value_id', 'tag_id']);

            $table->foreign('config_value_id')->references('id')->on('site_config')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('site_config_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_config_values_tags');
    }
}
