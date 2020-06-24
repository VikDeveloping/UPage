<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCompanies extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_companies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('country_id');
            $table->integer('state_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_companies');
    }
}
