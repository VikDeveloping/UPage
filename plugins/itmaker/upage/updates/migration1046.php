<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1046 extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('users', 'phone')) {
            return;
        }
        Schema::table('users', function ($table){
            $table->string('phone')->nulable();
        });
    }

    public function down()
    {
        
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
               $table->dropColumn(['phone']); 
            });
        }
        
    }
}