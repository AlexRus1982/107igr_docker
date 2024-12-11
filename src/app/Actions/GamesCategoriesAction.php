<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('GamesCategories')]
    class GamesCategoriesAction extends ActionClass {

        public function handle($args) {
            // $time_start = microtime(true);

            $categories = DB::table('categories')
            ->where('main_url', 'games')
            ->orderBy('order')
            ->get();

            $apps = DB::table('base')
            ->select('category_id', 'activity', 'downloads', 'icon')
            ->get();

            $appsStat = new \stdClass();
            foreach ($apps as $app) {
                if (!isset($appsStat->{"{$app->category_id}"})) {
                    $appsStat->{"{$app->category_id}"}                              = new \stdClass();
                    $appsStat->{"{$app->category_id}"}->{'downloads'}               = $app->activity == '1' ? $app->downloads : 0;
                    $appsStat->{"{$app->category_id}"}->{'icon'}              = $app->activity == '1' ? $app->icon : '';
                } else {
                    $stat                   = $appsStat->{"{$app->category_id}"};
                    if ($stat->downloads <= $app->downloads && $app->activity == '1') {
                        $stat->downloads    = $app->downloads;
                        $stat->icon   = $app->icon;
                    }
                }
            }

            $gamesCategoriesList = [];
            foreach ($categories as $category) {
                // $popularGame = DB::table('base')
                // ->where('base.activity', 1)
                // ->where('category_id', $category->id)
                // ->orderByDesc('downloads')
                // ->first();

                array_push($gamesCategoriesList, [
                    'category_image' => $appsStat->{"{$category->id}"}->icon,
                    'category_name'  => $category->category,
                    'category_url'   => $category->url,
                ]);
            }

            // $time = microtime(true) - $time_start;
            // logger("Список игр - выполнено за {$time} секунд.");

            return $gamesCategoriesList;
        }
    }
?>