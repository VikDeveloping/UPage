<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoryCompany11 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->integer('category_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_category_company', function($table)
        {
            $table->dropColumn('category_id');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
