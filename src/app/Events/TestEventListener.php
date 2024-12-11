<?php
    namespace App\Events;

    #[EventListenerFor('TestEvent')]
    class TestEventListener extends EventListenerClass {

        public function handle($args) {
            $className = self::class;
            logger($className . " - " . json_encode($args));
        }
    
    }
?>