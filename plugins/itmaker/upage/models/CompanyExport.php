<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */
class CompanyExport extends \Backend\Models\ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $companies = Company::all();
        $companies->each(function($company) use ($columns) {
            $company->addVisible($columns);
        });
        return $companies->toArray();
    }
}