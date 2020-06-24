<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Favorite extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_favorites';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'company' => \Itmaker\Upage\Models\Company::class
    ];

    
}
