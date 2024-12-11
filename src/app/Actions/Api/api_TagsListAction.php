<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_TagsList')]
    class api_TagsListAction extends ActionClass {

        public function handle($args) {

            $tags = DB::table('tags')
            ->get();

            $tagsList = [];
            foreach ($tags as $tag) {
                $tag_links_apps = DB::table('tags_links')
                ->join('base', 'base.id', '=', 'tags_links.app_id')
                ->where('tag_id', $tag->id)
                ->select('base.name', 'base.url')
                ->get();

                $tag_links_blogs = DB::table('tags_links')
                ->join('blogs', 'blogs.id', '=', 'tags_links.blog_id')
                ->where('tag_id', $tag->id)
                ->select('blogs.title', 'blogs.url')
                ->get();

                array_push($tagsList, [
                    'tag'             => $tag,
                    'tag_links_apps'  => $tag_links_apps,
                    'tag_links_blogs' => $tag_links_blogs,
                ]);
            }

            return $tagsList;
        }
    }
?>