<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class CompanyReview extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_company_reviews';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $belongsTo = [
        'company' => Company::class,
        'user'    => '\Rainlab\User\Models\User'
    ];

    public $guarded = [
        'id'
    ];
}
