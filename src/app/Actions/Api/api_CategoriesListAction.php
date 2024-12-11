<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_CategoriesList')]
    class api_CategoriesListAction extends ActionClass {

        public function handle($args) {
            // $time_start = microtime(true);

            $categories = DB::table('categories')
            ->orderBy('order')
            ->get();

            $apps = DB::table('base')
            ->where('activity', 1)
            ->select('id', 'category_id', 'activity', 'downloads', 'icon')
            ->get();

            $appsStat = new \stdClass();
            foreach ($apps as $app) {
                if (!isset($appsStat->{"{$app->category_id}"})) {
                    $appsStat->{"{$app->category_id}"}                              = new \stdClass();
                    $appsStat->{"{$app->category_id}"}->{'id'}                      = $app->id;
                    $appsStat->{"{$app->category_id}"}->{'category_count'}          = 1;
                    $appsStat->{"{$app->category_id}"}->{'category_active_count'}   = $app->activity == '1' ? 1 : 0;
                    $appsStat->{"{$app->category_id}"}->{'downloads'}               = $app->downloads;
                    $appsStat->{"{$app->category_id}"}->{'icon'}              = $app->icon;
                } else {
                    $stat                           = $appsStat->{"{$app->category_id}"};
                    $stat->id                       = $app->id;
                    $stat->category_count           = $stat->category_count + 1;
                    $stat->category_active_count    = $stat->category_active_count + ($app->activity == '1' ? 1 : 0);
                    
                    if ($stat->downloads <= $app->downloads) {
                        $stat->downloads            = $app->downloads;
                        $stat->icon           = $app->icon;
                    }
                }
            }

            $categoriesList = [];
            foreach ($categories as $category) {

                // 1.5s - 2s
                // $inCategoryActive = DB::table('base')
                // ->where('base.activity', 1)
                // ->where('category_id', $category->id)
                // ->count();

                // 2s
                // $inCategoryAll = DB::table('base')
                // ->where('category_id', $category->id)
                // ->count();

                // 2s
                // $popular = DB::table('base')
                // ->where('base.activity', 1)
                // ->where('category_id', $category->id)
                // ->orderByDesc('downloads')
                // ->first();

                // $actual_link = "https://{$_SERVER[HTTP_HOST]}{$_SERVER[REQUEST_URI]}";
                // $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

                array_push($categoriesList, [
                    'category_image'        => $appsStat->{"{$category->id}"}->icon,
                    'category'              => $category,
                    'category_count'        => $appsStat->{"{$category->id}"}->category_count,
                    'category_active_count' => $appsStat->{"{$category->id}"}->category_active_count,
                ]);
            }

            // $time = microtime(true) - $time_start;
            // logger("Выполнено за {$time} секунд.");

            return $categoriesList;
        }
    }
?>