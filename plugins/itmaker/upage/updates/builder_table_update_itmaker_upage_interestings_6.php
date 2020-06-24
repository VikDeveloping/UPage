<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageInterestings6 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->text('name');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->dropColumn('name');
        });
    }
}
