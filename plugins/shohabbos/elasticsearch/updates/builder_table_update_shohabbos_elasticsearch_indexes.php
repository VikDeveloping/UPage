<?php namespace Shohabbos\Elasticsearch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosElasticsearchIndexes extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_elasticsearch_indexes', function($table)
        {
            $table->text('settings')->nullable();
            $table->text('mappings')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_elasticsearch_indexes', function($table)
        {
            $table->dropColumn('settings');
            $table->dropColumn('mappings');
        });
    }
}
