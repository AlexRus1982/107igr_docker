<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('LikeInCategory')]
    class LikeInCategoryAction extends ActionClass {

        public function handle($args) {
            ['categoryId' => $categoryId] = $args;

            $likeInCategory = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->where('base.activity', 1)
            ->inRandomOrder()
            ->limit(10)
            ->get();

            return $likeInCategory;
        }
    }
?>