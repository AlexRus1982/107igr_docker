<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('GenerateSiteMap')]
    class GenerateSiteMapAction extends ActionClass {

        public function handle($args) {
            // logger('GenerateSiteMap');
            $page           = new \stdClass();
            
            return response()->view('main.sitemap', ['page' => $page])->header('Content-Type', 'text/xml');
        }
    }
?>