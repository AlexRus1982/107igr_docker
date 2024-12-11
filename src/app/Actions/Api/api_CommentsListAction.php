<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_CommentsList')]
    class api_CommentsListAction extends ActionClass {

        public function handle($args) {
            $comments = DB::table('comments')
            ->get()
            ->toArray();

            foreach ($comments as $comment) {
                if ($comment->app_id != -1) {

                    $app = DB::table('categories')
                    ->join('base', 'base.category_id', '=', 'categories.id')
                    ->where('base.id', $comment->app_id)
                    ->select('base.url', 'categories.main_url')
                    ->first();
                    
                    $comment->{'url'} = "/{$app->main_url}/{$app->url}";
                }

                if ($comment->blog_id != -1) {
                    $comment->{'url'} = "/blogs/" . DB::table('blogs')
                    ->where('id', $comment->blog_id)
                    ->select('url')
                    ->first()
                    ->url;
                }
            }

            return $comments;
        }
    }
?>