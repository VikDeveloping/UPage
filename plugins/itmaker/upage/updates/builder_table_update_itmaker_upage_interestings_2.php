<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageInterestings2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->boolean('is_active');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->dropColumn('is_active');
        });
    }
}
