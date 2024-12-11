<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_AppsUpdate')]
    class api_AppsUpdateAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            $columns = DB::getSchemaBuilder()->getColumnListing('base');

            $app_id = $request->app_DTO['id'];

            $new_data = [];
            foreach ($columns as $key) {
                if ($key != 'id') $new_data["{$key}"] = $request->app_DTO["{$key}"];
            }

            // logger($app_id);
            // logger(json_encode($columns, JSON_UNESCAPED_UNICODE));
            // logger(json_encode(array_keys($new_data), JSON_UNESCAPED_UNICODE));
            // logger(json_encode($new_data, JSON_UNESCAPED_UNICODE));

            DB::table('base')
            ->where('id', $app_id)
            ->update($new_data);
        }
    }
?>