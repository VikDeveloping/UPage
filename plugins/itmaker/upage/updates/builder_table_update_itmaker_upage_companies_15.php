<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies15 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->text('brand_name');
            $table->text('social_links');
            $table->text('keywords');
            $table->dropColumn('link_map');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->dropColumn('brand_name');
            $table->dropColumn('social_links');
            $table->dropColumn('keywords');
            $table->string('link_map', 191);
        });
    }
}
