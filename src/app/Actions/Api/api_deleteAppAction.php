<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_deleteApp')]
    class api_deleteAppAction extends ActionClass {

        public function handle($args) {

            ['request' => $request] = $args;

            DB::table('base')
            ->where('id', $request->app_id)
            ->delete();

            return response()->json([
                "server-answer" => "success",
            ]);
        }
    }
?>