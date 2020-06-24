<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageFavorites extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_favorites', function($table)
        {
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_favorites', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
