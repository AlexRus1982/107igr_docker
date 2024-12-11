<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_PagesList')]
    class api_PagesListAction extends ActionClass {

        public function handle($args) {
            $pages = DB::table('pages')
            ->get();

            return $pages;
        }
    }
?>