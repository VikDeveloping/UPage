<?php namespace Itmaker\Upage\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class CategoryViews extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_category_views' 
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
