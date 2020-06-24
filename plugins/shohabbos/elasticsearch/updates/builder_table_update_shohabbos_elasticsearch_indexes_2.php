<?php namespace Shohabbos\Elasticsearch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosElasticsearchIndexes2 extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_elasticsearch_indexes', function($table)
        {
            $table->boolean('is_advanced')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_elasticsearch_indexes', function($table)
        {
            $table->dropColumn('is_advanced');
        });
    }
}
