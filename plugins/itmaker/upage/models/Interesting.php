<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Interesting extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_interestings';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $attachOne = [
        'image' => 'System\Models\File'    
    ];
    
    public function scopeInterestings ($query, $options) {
        /*
        ** Default options
        */
        extract(array_merge([
            'limit'    => 20,
        ], $options));
        
        $query->where('is_active', true)
              ->orderByDesc('created_at');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        
        return $query->get();
        
    }
    
}

















