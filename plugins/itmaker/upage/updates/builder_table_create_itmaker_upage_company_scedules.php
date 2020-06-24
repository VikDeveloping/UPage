<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCompanyScedules extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_company_scedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('day');
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->boolean('is_weekend');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_company_scedules');
    }
}
