<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Location extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_locations';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $hasMany = [
        'children' => [Location::class, 'key' => 'parent_id']    
    ];
    
    protected $guarded = [];
}
