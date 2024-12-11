<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('CategoriesList')]
    class CategoriesListAction extends ActionClass {

        public function handle($args) {
            ['main_url' => $main_url] = $args;

            $categories = DB::table('categories')
            ->where('main_url', $main_url)
            ->orderBy('order')
            ->get();

            $CategoriesList = [];

            foreach ($categories as $category) {
                $count = DB::table('base')
                ->where('base.activity', 1)
                ->where('category_id', $category->id)
                ->orderByDesc('downloads')
                ->count();

                $popular = DB::table('base')
                ->where('base.activity', 1)
                ->where('category_id', $category->id)
                ->orderByDesc('downloads')
                ->select('url', 'name', 'icon', 'size')
                ->limit(10)
                ->get();

                array_push($CategoriesList, [
                    'category_main_url'   => $main_url,
                    'category_name'       => $category->category,
                    'category_url'        => $category->url,
                    'category_list'       => $popular,
                    'category_list_count' => $count,
                ]);
            }

            return $CategoriesList;
        }
    }
?>