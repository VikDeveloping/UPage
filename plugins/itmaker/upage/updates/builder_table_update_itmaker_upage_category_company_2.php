<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoryCompany2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->integer('category_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->integer('category_id')->unsigned(false)->change();
            $table->integer('company_id')->unsigned(false)->change();
        });
    }
}
