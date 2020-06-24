<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpagePhoneVerefications extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_phone_verefications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('phone', 13);
            $table->integer('code')->nullable();
            $table->boolean('verified')->nullable()->default(0);
            $table->integer('resend');
            $table->integer('user_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_phone_verefications');
    }
}
