<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoryCompany extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->integer('company_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->integer('company_id')->nullable(false)->change();
        });
    }
}
