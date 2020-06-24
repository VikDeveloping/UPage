<?php namespace Itmaker\Upage\Models;

use Model;

/**
 * Model
 */

class CompanyImport extends \Backend\Models\ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];


    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {

            try {
                $company = new Company;
                $company->fill($data);
                $company->save();

                $this->logCreated();
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }

        }
    }
}