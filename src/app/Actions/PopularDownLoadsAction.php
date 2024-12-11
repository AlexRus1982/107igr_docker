<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PopularDownLoads')]
    class PopularDownLoadsAction extends ActionClass {

        public function handle($args) {
            $popularDownLoads = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('base.activity', 1)
            ->orderByDesc('downloads')
            ->limit(10)
            ->get();

            return json_decode($popularDownLoads, true);
        }
    }
?>