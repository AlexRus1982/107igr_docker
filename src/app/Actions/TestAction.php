<?php
    namespace App\Actions;

    // use Illuminate\Support\Facades\DB;

    #[ActionFor('Test')]
    class TestAction extends ActionClass {

        public function handle($args) {
            $className = self::class;
            logger($className . " - " . json_encode($args, JSON_UNESCAPED_UNICODE));
            return 'TestAction';
        }
    }
?>