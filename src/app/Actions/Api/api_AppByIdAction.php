<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_AppById')]
    class api_AppByIdAction extends ActionClass {

        public function handle($args) {
            ['id' => $id] = $args;

            $app = DB::table('categories')
            ->join('base', 'base.category_id', '=', 'categories.id')
            ->where('base.id', $id)
            ->first();

            // $app = DB::table('base')
            // ->where('id', $id)
            // ->first();

            return $app;
        }
    }
?>