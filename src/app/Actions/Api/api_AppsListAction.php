<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_AppsList')]
    class api_AppsListAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            $searchParam = isset($_GET['search']) ? $_GET['search'] : '';
            $sortParam = isset($_GET['sort']) ? $_GET['sort'] : '';
            $filterParam = isset($_GET['filter']) ? $_GET['filter'] : '';

            // logger("searchParam - {$searchParam}");
            // logger("sortParam   - {$sortParam}");
            // logger("filterParam - {$filterParam}");

            $apps = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id');
            if ($searchParam != '') {
                $apps = $apps->where('name', 'like', "%{$searchParam}%");
            }

            if ($filterParam == 'games' ) {
                $apps = $apps->where('category_id', '<', '10000');
            } elseif ($filterParam == 'apps' ) {
                $apps = $apps->where('category_id', '>=', '10000');
            } elseif ($filterParam != '') {
                $apps = $apps->where('category_id', $filterParam);
            }

            if ($sortParam != '') {
                $sortBy    = explode(',', $sortParam)[0];
                $sortOrder = explode(',', $sortParam)[1];
                $apps = $apps->orderBy($sortBy, $sortOrder);
            }

            $apps = $apps->paginate(60)
            ->toArray();

            // logger(json_encode($apps, JSON_UNESCAPED_UNICODE));

            foreach ($apps['data'] as $item) {
                $tags_count = DB::table('tags_links')
                ->where('app_id', $item->id)
                ->count();

                $item->{'tags_count'} = $tags_count;
            }

            return $apps;
        }
    }
?>