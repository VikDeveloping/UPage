<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCategoriesCompanies extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_category_company', 'itmaker_upage_categories_companies');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_categories_companies', 'itmaker_upage_category_company');
    }
}
