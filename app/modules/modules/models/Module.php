<?php namespace App\Modules\Modules\Models;

use Exception, File, BaseModel;

class Module extends BaseModel {

    protected $fillable = ['title'];

    /**
     * Returns an array with models for all existing modules
     * 
     * @return array
     */
    public static function findAll()
    {
        $dirs = File::directories(app_path().'/modules');

        array_walk($dirs, 'self::createInstance');

        return $dirs;
    }

    /**
     * Function for the array walker. Creates (and returns) an instance for the given module name.
     * 
     * @param  string $item The module name (path included)
     * @return Module
     */
    protected static function createInstance(&$item)
    {
        $item = new Module(['title' => class_basename($item)]);
    }

    /**
     * Check if a installer file exists. Returns filename or false.
     * 
     * @return string|boolean
     */
    public function installer()
    {
        $fileName = app_path().'/modules/'.$this->title.'/Installer.php';
        
        if (File::exists($fileName)) {
            return $fileName;
        } else {
            return false;
        }
    }

    public function enabled()
    {
        $finder     = app()['modules'];
        $modules    = $finder->modules(); // Retrieve all module info objects
        $module     = $modules[$this->title];
        
        return $module->enabled();
    }

}