<?php namespace Itmaker\Upage\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class CompanyViews extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_company_views' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Itmaker.Upage', 'companies', 'company-views');
    }
}
