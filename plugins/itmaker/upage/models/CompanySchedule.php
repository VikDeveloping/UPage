<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class CompanySchedule extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_company_schedules';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
