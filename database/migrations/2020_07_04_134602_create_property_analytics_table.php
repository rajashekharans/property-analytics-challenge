<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_analytics', function (Blueprint $table) {
            $table->id()->unique();
            $table->text('value');
            $table->timestamps();
        });

        Schema::table('property_analytics', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained();
            $table->foreignId('analytic_type_id')->constrained();
            $table->dropPrimary('id');
            $table->primary(['property_id', 'analytic_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_analytics');
    }
}
