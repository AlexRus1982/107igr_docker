<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_BlogsList')]
    class api_BlogsListAction extends ActionClass {

        public function handle($args) {
            $blogs = DB::table('blogs')
            ->get()
            ->toArray();

            foreach ($blogs as $blog) {
                $tags = DB::table('tags_links')
                ->join('tags', 'tags.id', '=', 'tags_links.tag_id')
                ->where('blog_id', $blog->id)
                ->get()
                ->toArray();

                $blog->{'tags'} = $tags;

                $comments_count = DB::table('comments')
                ->where('blog_id', $blog->id)
                ->count();

                $blog->{'comments_count'} = $comments_count;
            }

            return $blogs;
        }
    }
?>