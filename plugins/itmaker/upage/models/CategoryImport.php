<?php namespace Itmaker\Upage\Models;

use Model;
use Itmaker\Upage\Models\Category;

/**
 * Model
 */
class CategoryImport extends \Backend\Models\ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        
        foreach ($results as $row => $data) {

            //[id] => 152
            //[name] => Инспекции
            //[nest_left] => 302
            //[nest_right] => 303
            //[parent_id] => 117

            try {
                $category = new Category;
                $category->fill($data);
                $category->save();

                $this->logCreated();
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }

        }
    }
}