<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosters6 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->dropColumn('is_today');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->boolean('is_today');
        });
    }
}
