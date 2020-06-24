<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategories extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_categories', function($table)
        {
            $table->renameColumn('title', 'name');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_categories', function($table)
        {
            $table->renameColumn('name', 'title');
        });
    }
}
