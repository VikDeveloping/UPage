<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class CompanyView extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_company_views';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $belongsTo = [
        'company' => Company::class
    ];
    
   
    
    public function scopeLastThreeTops ($query, $options) {
        /*
        ** Dfault options
        */
        extract(array_merge([
            'current_month'  => date('Y-m'),
            'last_month'     => "0000-00",
            'pre_last_month' => "2019-01",
            'limit'          => 20
        ], $options));
        
        if ($current_month) {;
        }
        
        
        $query->whereBetween('date', [$pre_last_month.'-1', $current_month.'-31']);
        
        if ($current_month) {
            $currentTop = &$query;
        
            $currentTop->whereBetween('date', [$currentMonth.'-1', $currentMonth.'-31'])
                       ->select(['*', DB::raw("SUM(views) as total_views")])
                       ->groupBy('company_id')
                       ->orderByDesc('total_views')
                       ->limit(20)
                       ->get();
            $query->currnetTop = $currnetTop;
        }
        return $query->get();

    }
}