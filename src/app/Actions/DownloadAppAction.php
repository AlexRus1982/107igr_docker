<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('DownloadApp')]
    class DownloadAppAction extends ActionClass {

        public function handle($args) {
            // logger('DownloadApp');
            ['url' => $url] = $args;

            $page           = new \stdClass();
            $page->{'url'}  = $url;

            $app = DB::table('base')
            ->where('url', $url)
            ->where('activity', 1)
            ->first();

            // logger(json_encode($app, JSON_UNESCAPED_UNICODE));
    
            if ($app == null) {
                return abort(404);
            }
            
            $page->{'app'} = $app;

            if ($app->redirect == '1' && $app->redirect_url != '') {
                // logger('redirect');
                // return view('main.download', ['page' => $page]);
                return redirect($app->redirect_url, 301);
            }
            
            $category = DB::table('categories')
            ->where('id', $app->category_id)
            ->first();
            
            $app->{'category'}           = $category;
            $page->{'category'}          = $category;
            $page->{'PopularInCategory'} = ActionsSystem::Action('PopularInCategory', ['categoryId' => $category->id]);

            return view('main.download', ['page' => $page]);
        }
    }
?>