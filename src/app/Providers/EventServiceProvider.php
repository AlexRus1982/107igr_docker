<?php

namespace App\Events;

abstract class EventListenerClass {
    abstract protected function handle($args);
}

class EventsSystem {
    
    private static $events = array();

    public static function registerEventListener($eventName, $eventListenerClass) {
        if (!array_key_exists($eventName, self::$events)) {
            self::$events[$eventName] = [];
        }

        $listenerExists = false;
        $listeners = self::$events[$eventName];
        foreach ($listeners as $listener) {
            if ($eventListenerClass == $listener) {
                $listenerExists = true;
                break;
            }
        }        

        if (!$listenerExists) {
            array_push(self::$events[$eventName], $eventListenerClass);
            // logger("EventListener - {$eventListenerClass} on event {$eventName} registered.");
        }
    }

    public static function Event($eventName, $args = null) {

        $listeners = self::$events[$eventName];
        foreach ($listeners as $listener) {
            $class = "App\Events\\" . $listener;
            $instance = new $class();
            $instance->handle($args);
        }
    }

    public static function registeredEvents() {
        // logger(self::$events);
    }
}

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    private function getFiles($dir, &$files_array) {
        $files = array_diff(scandir($dir), ['..', '.']);
        
        foreach ($files as $file) {
            $path = $dir . '/' .$file;
            
            if (is_dir($path)) {
                $this->getFiles($path, $files_array);
            }
            else {
                if (fnmatch('*EventListener.php', $file)){
                    array_push($files_array, $path);
                }
            }
        }
        
    } 

    public function register(): void
    {
        $files_array = array();
        $this->getFiles(app_path('Events'), $files_array);

        foreach ($files_array as $file) {
            require_once $file;
            $className = basename($file, ".php");

            $reflection = new \ReflectionClass('App\Events' . '\\' . $className);
            $attributes = $reflection->getAttributes();
            foreach ($attributes as $attribute) {
                $attributeName = $attribute->getName();
                if ($attributeName == 'App\Events\EventListenerFor'){
                    $actionName = $attribute->getArguments()[0];
                    \App\Events\EventsSystem::registerEventListener($actionName, $className);
                }
            }
        }
    }

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
