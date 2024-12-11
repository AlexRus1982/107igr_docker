<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_PageById')]
    class api_PageByIdAction extends ActionClass {

        public function handle($args) {
            ['id' => $id] = $args;

            $page = DB::table('pages')
            ->where('id', $id)
            ->first();

            return $page;
        }
    }
?>