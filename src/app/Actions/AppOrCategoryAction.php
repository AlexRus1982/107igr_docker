<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('AppOrCategory')]
    class AppOrCategoryAction extends ActionClass {

        public function handle($args) {
            ['main_url' => $main_url, 'url' => $url] = $args;

            $page               = new \stdClass();
            $page->{'main_url'} = $main_url;
            $page->{'url'}      = $url;

            $category = DB::table('categories')
            ->where('url', $url)
            ->first();
    
            // logger(json_encode($category, JSON_UNESCAPED_UNICODE));
    
            if ($category == null) {
                $app = DB::table('base')
                ->where('url', $url)
                ->where('activity', 1)
                ->first();

                // logger(json_encode($app, JSON_UNESCAPED_UNICODE));
    
                if ($app == null) {
                    // logger('redirect');
                    return abort(404);
                }

                $category = DB::table('categories')
                ->where('id', $app->category_id)
                ->first();

                $app->{'category'}           = $category;
                $page->{'app'}               = $app;
                $page->{'category'}          = $category;
                // $page->{'screenShots'}       = explode(';', $app->images);
                $page->{'screenShots'}       = json_decode($app->screen_shots);
                $page->{'DeveloperOther'}    = ActionsSystem::Action('DeveloperOther', ['selfId' => $app->id, 'developer' => $app->developer]);
                $page->{'PopularBlogs'}      = ActionsSystem::Action('PopularBlogs');
                $page->{'PopularInCategory'} = ActionsSystem::Action('PopularInCategory', ['categoryId' => $category->id]);
                $page->{'LikeInCategory'}    = ActionsSystem::Action('LikeInCategory', ['categoryId' => $category->id]);
                
                return view('main.app-page', ['page' => $page]);
            }

            $list = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('category_id', $category->id)
            ->where('base.activity', 1)
            ->paginate(15);

            $popular = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('categories.id', $category->id)
            ->where('base.activity', 1)
            ->orderByDesc('downloads')
            ->limit(10)
            ->get();

            $page->{'category'} = $category;
            $page->{'list'}     = $list;
            $page->{'popular'}  = $popular;
    
            return view('main.category-page', ['page' => $page]);
        }
    }
?>