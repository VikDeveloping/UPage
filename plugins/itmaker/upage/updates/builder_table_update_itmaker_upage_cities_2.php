<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCities2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_cities', function($table)
        {
            $table->string('name')->change();
            $table->renameColumn('sort', 'sort_order');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_cities', function($table)
        {
            $table->string('name', 191)->change();
            $table->renameColumn('sort_order', 'sort');
        });
    }
}
