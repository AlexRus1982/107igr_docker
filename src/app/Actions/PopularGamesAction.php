<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('PopularGames')]
    class PopularGamesAction extends ActionClass {

        public function handle($args) {
            $popularGames = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('categories.main_url', 'games')
            ->where('base.activity', 1)
            ->orderByDesc('downloads')
            ->limit(10)
            ->get();

            return $popularGames;
        }
    }
?>