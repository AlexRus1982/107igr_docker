<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PopularInCategory')]
    class PopularInCategoryAction extends ActionClass {

        public function handle($args) {
            ['categoryId' => $categoryId] = $args;

            $popularInCategory = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->where('base.activity', 1)
            ->orderByDesc('downloads')
            ->limit(10)
            ->get();

            return $popularInCategory;
        }
    }
?>