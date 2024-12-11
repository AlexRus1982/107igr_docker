<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_AppsActivity')]
    class api_AppsActivityAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            DB::table('base')
            ->where('id', $request->id)
            ->update(['activity' => $request->activity]);
        }
    }
?>