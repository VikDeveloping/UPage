<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Banner extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_banners';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $attachOne = [
        'image' => 'System\Models\File'
    ];
    
    
    public function scopeBanners($query, $options) {
         /*
        * Default options
        */
        extract(array_merge([
            'type'   => null,
            'limit'  => 4,
            
        ], $options));
        
        $query->whereDate('deadline', '>=',date('Y-m-d h:s'))->where('is_active', true);
        if ($type) {
            $query->where('place', $type);
        }
        
        $query->orderByRaw('RAND()');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        $views = &$query;
        $views->increment('views');
        
        return $query->get();
        
    }
}

















