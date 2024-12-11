<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('NewerApps')]
    class NewerAppsAction extends ActionClass {

        public function handle($args) {
            $newerApps = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('base.activity', 1)
            ->inRandomOrder()
            ->limit(10)
            ->get();

            return $newerApps;
        }
    }
?>