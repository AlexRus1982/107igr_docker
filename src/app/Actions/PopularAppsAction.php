<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PopularApps')]
    class PopularAppsAction extends ActionClass {

        public function handle($args) {
            $popularApps = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('categories.main_url', 'apps')
            ->where('base.activity', 1)
            ->orderByDesc('downloads')
            ->limit(10)
            ->get();

            return $popularApps;
        }
    }
?>