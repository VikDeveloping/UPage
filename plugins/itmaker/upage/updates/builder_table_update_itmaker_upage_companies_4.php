<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies4 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->integer('sort_order')->nullable()->unsigned();
            $table->string('name')->change();
            $table->string('country')->change();
            $table->string('postcode')->change();
            $table->string('phone')->change();
            $table->string('fax')->change();
            $table->string('website')->change();
            $table->string('email')->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->dropColumn('sort_order');
            $table->string('name', 191)->change();
            $table->string('country', 191)->change();
            $table->string('postcode', 191)->change();
            $table->string('phone', 191)->change();
            $table->string('fax', 191)->change();
            $table->string('website', 191)->change();
            $table->string('email', 191)->change();
        });
    }
}
