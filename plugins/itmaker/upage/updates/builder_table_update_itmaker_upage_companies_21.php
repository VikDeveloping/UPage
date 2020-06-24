<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies21 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->string('postcode', 191)->default(null)->change();
            $table->dateTime('monday')->default(null)->change();
            $table->dateTime('tuesday')->default(null)->change();
            $table->dateTime('wednesday')->default(null)->change();
            $table->dateTime('thursday')->default(null)->change();
            $table->dateTime('friday')->default(null)->change();
            $table->dateTime('saturday')->default(null)->change();
            $table->dateTime('sunday')->default(null)->change();
            $table->dateTime('created_at')->default(null)->change();
            $table->dateTime('updated_at')->default(null)->change();
            $table->integer('sort_order')->default(null)->change();
            $table->integer('location_id')->default(null)->change();
            $table->integer('index')->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->string('postcode', 191)->default('NULL')->change();
            $table->dateTime('monday')->default('NULL')->change();
            $table->dateTime('tuesday')->default('NULL')->change();
            $table->dateTime('wednesday')->default('NULL')->change();
            $table->dateTime('thursday')->default('NULL')->change();
            $table->dateTime('friday')->default('NULL')->change();
            $table->dateTime('saturday')->default('NULL')->change();
            $table->dateTime('sunday')->default('NULL')->change();
            $table->timestamp('created_at')->default('NULL')->change();
            $table->timestamp('updated_at')->default('NULL')->change();
            $table->integer('sort_order')->default(NULL)->change();
            $table->integer('location_id')->default(NULL)->change();
            $table->integer('index')->default(NULL)->change();
        });
    }
}
