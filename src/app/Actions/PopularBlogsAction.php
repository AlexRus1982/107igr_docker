<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PopularBlogs')]
    class PopularBlogsAction extends ActionClass {

        public function handle($args) {
            $popularBlogs = DB::table('blogs')
            ->where('activity', 1)
            ->orderByDesc('visited')
            ->limit(8)
            ->get();

            return json_decode($popularBlogs, true);
        }
    }
?>