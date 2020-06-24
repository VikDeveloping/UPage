<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class PosterSchedule extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_poster_schedules';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $hasOne = [
        'poster' => Poster::class,
    ];
}
