<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_deleteCategory')]
    class api_deleteCategoryAction extends ActionClass {

        public function handle($args) {

            ['request' => $request] = $args;

            DB::table('categories')
            ->where('id', $request->category_id)
            ->delete();

            return response()->json([
                "server-answer" => "success",
            ]);
        }
    }
?>