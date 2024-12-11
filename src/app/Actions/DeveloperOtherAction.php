<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('DeveloperOther')]
    class DeveloperOtherAction extends ActionClass {

        public function handle($args) {
            ['selfId' => $selfId, 'developer' => $developer] = $args;

            $developerOther = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('base.developer', $developer)
            ->where('base.id', '<>', $selfId)
            ->where('base.activity', 1)
            ->get();

            return $developerOther;
        }
    }
?>