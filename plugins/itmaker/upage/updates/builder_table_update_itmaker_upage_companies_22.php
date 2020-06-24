<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies22 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->string('postcode', 191)->nullable()->change();
            $table->dateTime('monday')->nullable()->change();
            $table->dateTime('tuesday')->nullable()->change();
            $table->dateTime('wednesday')->nullable()->change();
            $table->dateTime('thursday')->nullable()->change();
            $table->dateTime('friday')->nullable()->change();
            $table->dateTime('saturday')->nullable()->change();
            $table->dateTime('sunday')->nullable()->change();
            $table->dateTime('created_at')->nullable()->change();
            $table->dateTime('updated_at')->nullable()->change();
            $table->integer('sort_order')->nullable()->change();
            $table->integer('location_id')->nullable()->change();
            $table->integer('index')->nullable()->change();
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
            $table->timestamp('updated_at')->nullable()->unsigned(false)->default('NULL')->change();
            $table->integer('sort_order')->default(NULL)->change();
            $table->integer('location_id')->default(NULL)->change();
            $table->integer('index')->default(NULL)->change();
        });
    }
}
