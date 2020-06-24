<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('region_id')->nullable()->unsigned();
            $table->string('country');
            $table->text('street');
            $table->string('postcode');
            $table->string('phone');
            $table->string('fax');
            $table->string('website');
            $table->string('email');
            $table->decimal('coor_lat', 12, 10);
            $table->decimal('coor_long', 12, 10);
            $table->dateTime('monday')->nullable();
            $table->dateTime('tuesday')->nullable();
            $table->dateTime('wednesday')->nullable();
            $table->dateTime('thursday')->nullable();
            $table->dateTime('friday')->nullable();
            $table->dateTime('saturday')->nullable();
            $table->dateTime('sunday')->nullable();
            $table->increments('id')->unsigned(false)->change();
            $table->string('name')->change();
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->dropColumn('city_id');
            $table->dropColumn('region_id');
            $table->dropColumn('country');
            $table->dropColumn('street');
            $table->dropColumn('postcode');
            $table->dropColumn('phone');
            $table->dropColumn('fax');
            $table->dropColumn('website');
            $table->dropColumn('email');
            $table->dropColumn('coor_lat');
            $table->dropColumn('coor_long');
            $table->dropColumn('monday');
            $table->dropColumn('tuesday');
            $table->dropColumn('wednesday');
            $table->dropColumn('thursday');
            $table->dropColumn('friday');
            $table->dropColumn('saturday');
            $table->dropColumn('sunday');
            $table->increments('id')->unsigned()->change();
            $table->string('name', 191)->change();
            $table->integer('country_id');
            $table->integer('state_id');
        });
    }
}
