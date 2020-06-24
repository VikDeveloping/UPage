<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $attachOne = [
        'icon' => 'System\Models\File'    
    ];
    
    protected $guarded = [];
    

    public $hasMany =[
        'companies' => [ Company::class, 'table' => 'itmaker_upage_category_company'],
        'childrens' => [ Category::class, 'key' => 'parent_id']
    ];

    public $belongsTo = [
        'categoryViews' => CategoryView::class
    ];

    public static function getCollectedCategories ()
    {
        return Category::where('is_active', true)->where('parent_id', 0)->with(['icon', 'childrens'])->get();
    }
    
}
