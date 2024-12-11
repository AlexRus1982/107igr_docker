<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_AppLinks')]
    class api_AppLinksAction extends ActionClass {

        public function handle($args) {

            ['request' => $request] = $args;

            $tags = DB::table('tags')
            ->get();

            $app_tag_links = DB::table('tags_links')
            ->join('tags', 'tags.id', '=', 'tags_links.tag_id')
            ->where('app_id', $request->app_id)
            ->get();

            return response()->json([
                "server-answer" => "success",
                "tags"          => $tags,
                "appLinks"      => $app_tag_links,
            ]);
        }
    }
?>