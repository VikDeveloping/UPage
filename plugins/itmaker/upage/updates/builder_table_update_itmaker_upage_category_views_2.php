<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoryViews2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_category_views', function($table)
        {
            $table->date('date')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_category_views', function($table)
        {
            $table->smallInteger('date')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
