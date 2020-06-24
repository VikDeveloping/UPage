<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategories2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_categories', function($table)
        {
            $table->integer('parent_id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_categories', function($table)
        {
            $table->integer('parent_id')->unsigned(false)->change();
        });
    }
}
