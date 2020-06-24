<?php namespace Itmaker\Upage\Models;

use Model;
use DB;
use Rainlab\User\Models\User;
/**
 * Model
 */
class Company extends Model
{
    
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    
    //public $implement = ['Shohabbos.Elasticsearch.Classes.Searchable'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_companies';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    protected $guarded = [];
    
    public $jsonable = [
        'properties', 'social_links', 'phones'  
    ];
    
    public $attachOne = [
        'logo' => 'System\Models\File'
    ];
    
    public $belongsTo = [
        'location' => Location::class,
        'type'     => CompanyType::class
    ];
    
    public $hasMany = [
        'companySchedules'  => CompanySchedule::class,
        'companyViews'      => CompanyView::class,
        'reviews'      => CompanyReview::class
    ];
    
    public $belongsToMany = [
        'categories'  => [ Category::class, 'table' => 'itmaker_upage_category_company'],
    ];
    
    
    public function getTypeIdOptions(){
        return CompanyType::where('is_active', true)->lists('name', 'id');
    }
    
    public function isFav() {
        $posts = \Cookie::get('wishlist', []);
        if($posts) {return isset($posts[$this->id]) ? 'active' : '';}
    }
    
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug,
        ];
        $params['category'] = $this->category ? $this->category->slug : null;
        
        //expose published year, month and day as URL parameters
        if ($this->published) {
            $params['year'] = $this->published_at->format('Y');
            $params['month'] = $this->published_at->format('m');
            $params['day'] = $this->published_at->format('d');
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }
    public function scopeCompanyList($query, $options){
        /*
        * Default options
        */
        extract(array_merge([
            'category'         => null,
            'city'             => null,
            'district'         => null,
        	'page'             => 1,
        	'perPage'          => 20,
        	'sort'             => 'created_at',
        	'search'           => '',
        ], $options));
        
        $query->with([
            'logo', 
            'categories', 
            'reviews', 
            'companySchedules', 
            'companyViews',
            'location',
            'type'
        ]);
        
        
        if ($district) {
            $query->where('location_id', $district);
        } elseif ($city) {
            $query->where('location_id', $city);
        }
    
        
        if ($category) {
            
            $category = Category::remember(10)->where('id', $category)->first()->getAllChildrenAndSelf();
            $cat = [];
            foreach ($category as $c) {
                $cat[] = $c->id;
            }
            $post=[];
            $qq = DB::table('itmaker_upage_category_company')->remember(10)->whereIn('category_id', $cat)->get();
            foreach ($qq as $q) {
                $post[] = $q->company_id;
            }
            $query->whereIn('id',$post);
        }
        $searchableFields = ['name', 'brand_name', 'keywords', 'phones', 'street'];
        /*
        * Search
        */
        $search = trim($search);
        if (strlen($search) > 2) {
        	$query->searchWhere($search, $searchableFields);
        }
        return $query->paginate($perPage, $page);
    }
    
    public function scopeGetCompany ($query, $options) {
        /*
        ** Default options
        */
        extract(array_merge([
            'id' => null
        ], $options));
        
        if ($id) {
            $query->where('id', $id);
        }
        return $query->first();
    }
    
    public function getFavorites(){
        $favorites = Favorite::get();
        if(!$favorites){ return;}
        
        $fav = [];
        foreach( $favorites as $favorite ) {
            $fav[] = $favorite->company_id;
        }
        
        $fav = array_unique($fav);
        $this['companies'] = Company::whereIn('id', $fav)->get();
    }
}
