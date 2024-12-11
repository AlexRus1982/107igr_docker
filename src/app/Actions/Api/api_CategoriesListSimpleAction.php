<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_CategoriesListSimple')]
    class api_CategoriesListSimpleAction extends ActionClass {

        public function handle($args) {

            $categories = DB::table('categories')
            ->orderBy('order')
            ->get();

            return $categories;
        }
    }
?>