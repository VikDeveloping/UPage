<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Poster extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_posters';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $hasMany = [
       'posterSchedules'  => PosterSchedule::class,
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    protected $jsonable = ['timetable'];
    
    public $attachOne = [
        'image' => 'System\Models\File'
    ];
    
    
    public function scopeListTodaySchedules () {
        $date = date("Y-m-d");
        
        $query = Poster::where('is_active', true);
        
        
        
        return $query->get();
    }
    
     public function scopePosters($query, $options) {
         /*
        * Default options
        */
        extract(array_merge([
            'limit'    => 20,
            'date'     => null
        ], $options));
            
        
        $query->where('is_active', true);
        
        
        if ($date) {
            $query->whereHas('posterSchedules', function($obQuery) use ($date) {
                $obQuery->whereBetween('start', [$date.' 00:00', $date.' 23:59']);
            });
        }
        
        $query->orderByDesc('created_at');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        
        
        
        return $query->get();
        
    }
    
    
    
    
    
}
