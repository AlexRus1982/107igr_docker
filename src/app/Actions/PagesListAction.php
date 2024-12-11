<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PagesList')]
    class PagesListAction extends ActionClass {

        public function handle($args) {
            $pages = DB::table('pages')
            ->get();

            foreach ($pages as $page) {
                $page->{'route'} = "{$page->url}.page";
            }

            return json_decode($pages, true);
        }
    }
?>