<?php

namespace App\Helpers\Routes;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RouteHelper
{
    public static function includeRouteFiles(string $folder)
    {
        $dirIterator = new RecursiveDirectoryIterator($folder);

        /** 
         * @var RecursirveDirectoryIterator
         * @var RecursiveIteratorIterator $iterator 
         * */
        $iterator = new RecursiveIteratorIterator($dirIterator);

        while ($iterator->valid()) {
            if(
                !$iterator->isDot() 
                && $iterator->isFile() 
                && $iterator->isReadable() 
                && $iterator->current()->getExtension() === 'php') 
                {
                    require $iterator->key();
                }
            
            $iterator->next();
        }
    }
}