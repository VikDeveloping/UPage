<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCompanyViews extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_company_views', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date');
            $table->integer('company_id')->nullable();
            $table->integer('views')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_company_views');
    }
}
