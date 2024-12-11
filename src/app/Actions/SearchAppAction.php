<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('SearchApp')]
    class SearchAppAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            $searchParam = isset($_GET['searchParam']) ? $_GET['searchParam'] : '';
            // $sortParam = isset($_GET['sort']) ? $_GET['sort'] : '';
            // $filterParam = isset($_GET['filter']) ? $_GET['filter'] : '';

            // logger("searchParam - {$searchParam}");
            // logger("sortParam   - {$sortParam}");
            // logger("filterParam - {$filterParam}");

            $page                       = new \stdClass();
            $page->{'SearchParam'}      = $searchParam;
            // $page->{'PopularGames'}     = ActionsSystem::Action('PopularGames');
            // $page->{'PopularApps'}      = ActionsSystem::Action('PopularApps');
            // $page->{'NewerApps'}        = ActionsSystem::Action('NewerApps');

            $apps = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id');
            if ($searchParam != '') {
                $apps = $apps->where('name', 'like', "%{$searchParam}%");
            }

            // if ($filterParam == 'games' ) {
            //     $apps = $apps->where('category_id', '<', '10000');
            // } elseif ($filterParam == 'apps' ) {
            //     $apps = $apps->where('category_id', '>=', '10000');
            // } elseif ($filterParam != '') {
            //     $apps = $apps->where('category_id', $filterParam);
            // }

            // if ($sortParam != '') {
            //     $sortBy    = explode(',', $sortParam)[0];
            //     $sortOrder = explode(',', $sortParam)[1];
            //     $apps = $apps->orderBy($sortBy, $sortOrder);
            // }

            $apps = $apps->paginate(10);
            // ->toArray();

            $page->{'SearchingResult'} = $apps;

            // logger(json_encode($apps, JSON_UNESCAPED_UNICODE));

            return view('main.search', ['page' => $page]);
        }
    }
?>