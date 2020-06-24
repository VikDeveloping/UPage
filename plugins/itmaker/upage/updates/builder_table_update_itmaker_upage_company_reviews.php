<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanyReviews extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_company_reviews', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_company_reviews', function($table)
        {
            $table->dropColumn('deleted_at');
        });
    }
}
