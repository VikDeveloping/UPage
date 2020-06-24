<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePhoneVerifications extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_phone_verefications', 'itmaker_upage_phone_verifications');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_phone_verifications', 'itmaker_upage_phone_verefications');
    }
}
