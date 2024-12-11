<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_PagesUpdate')]
    class api_PagesUpdateAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            $columns = DB::getSchemaBuilder()->getColumnListing('pages');

            $page_id = $request->page_DTO['id'];

            $new_data = [];
            foreach ($columns as $key) {
                if ($key != 'id') $new_data["{$key}"] = $request->page_DTO["{$key}"];
            }

            DB::table('pages')
            ->where('id', $page_id)
            ->update($new_data);
        }
    }
?>