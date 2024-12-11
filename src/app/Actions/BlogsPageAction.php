<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('BlogsPage')]
    class BlogsPageAction extends ActionClass {

        public function handle($args) {
            // logger('BlogsPage');
            $page           = new \stdClass();

            $blogs = DB::table('blogs')
            ->where('activity', 1)
            ->get();
            
            $page->{'blogs'} = $blogs;

            return view('main.blogs', ['page' => $page]);
        }
    }
?>