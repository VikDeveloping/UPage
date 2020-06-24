<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoryViews extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_category_views', function($table)
        {
            $table->smallInteger('date');
            $table->integer('category_id')->nullable()->change();
            $table->integer('views')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_category_views', function($table)
        {
            $table->dropColumn('date');
            $table->integer('category_id')->nullable(false)->change();
            $table->integer('views')->nullable(false)->change();
        });
    }
}
