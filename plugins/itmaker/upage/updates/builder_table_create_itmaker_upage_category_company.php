<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCategoryCompany extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_category_company', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('company_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_category_company');
    }
}
