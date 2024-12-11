<?php

namespace App\Actions;

abstract class ActionClass {
    abstract protected function handle($args);
}

class ActionsSystem {

    private static $actions = array();

    public static function registerAction($actionName, $actionClass) {
        if (!(key_exists($actionName, self::$actions) && self::$actions[$actionName] == $actionClass)) {
            self::$actions[$actionName] = $actionClass;
            // logger("{$actionName} registered.");
        }
    }

    public static function Action($actionName, $args = null) {
        $class = "App\Actions\\" . self::$actions[$actionName];
        $instance = new $class();
        return $instance->handle($args);
    }

    public static function registeredActions() {
        // logger(self::$actions);
    }
}

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider {
    
    private function getFiles($dir, &$files_array) {
        $files = array_diff(scandir($dir), ['..', '.']);
        
        foreach ($files as $file) {
            $path = $dir . '/' .$file;
            
            if (is_dir($path)) {
                $this->getFiles($path, $files_array);
            }
            else {
                if (fnmatch('*Action.php', $file)){
                    array_push($files_array, $path);
                }
            }
        }
        
    } 
    
    //Register services.
    public function register(): void {
        $files_array = array();
        $this->getFiles(app_path('Actions'), $files_array);

        foreach ($files_array as $file) {
            require_once $file;
            $className = basename($file, ".php");
            // logger($className);

            $reflection = new \ReflectionClass('App\Actions' . '\\' . $className);
            $attributes = $reflection->getAttributes();
            foreach ($attributes as $attribute) {
                $attributeName = $attribute->getName();
                if ($attributeName == 'App\Actions\ActionFor'){
                    $actionName = $attribute->getArguments()[0];
                    \App\Actions\ActionsSystem::registerAction($actionName, $className);
                }
            }
        }
    }
}
