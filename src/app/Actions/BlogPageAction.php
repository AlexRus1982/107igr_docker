<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('BlogPage')]
    class BlogPageAction extends ActionClass {

        public function handle($args) {
            // logger('BlogPage');
            ['url' => $url] = $args;

            $page           = new \stdClass();
            $page->{'url'}  = $url;

            $blog = DB::table('blogs')
            ->where('url', $url)
            ->where('activity', 1)
            ->first();

            // logger(json_encode($blog, JSON_UNESCAPED_UNICODE));
    
            if ($blog == null) {
                return abort(404);
            }
            
            $page->{'blog'} = $blog;

            return view('main.blog', ['page' => $page]);
        }
    }
?>