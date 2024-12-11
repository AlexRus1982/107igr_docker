<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_CategoryInfo')]
    class api_CategoryInfoAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            $category = DB::table('categories')
            ->where('id', $request->category_id)
            ->first();

            $apps = DB::table('base')
            ->where('category_id', $request->category_id)
            ->where('activity', 1)
            ->select('id', 'category_id', 'activity', 'downloads', 'icon')
            ->get();

            $categoryInfo = new \stdClass();
            $categoryInfo->{'category'}                 = $category;
            $categoryInfo->{'category_id'}              = $request->category_id;
            $categoryInfo->{'category_count'}           = 0;
            $categoryInfo->{'category_active_count'}    = 0;
            $categoryInfo->{'downloads'}                = 0;
            $categoryInfo->{'icon'}               = '';

            foreach ($apps as $app) {
                $categoryInfo->category_count                   = $categoryInfo->category_count + 1;
                $categoryInfo->category_active_count            = $categoryInfo->category_active_count + ($app->activity == '1' ? 1 : 0);
                
                if ($categoryInfo->downloads <= $app->downloads) {
                    $categoryInfo->downloads                    = $app->downloads;
                    $categoryInfo->icon                   = $app->icon;
                }
            }

            return response()->json([
                "server-answer" => "success",
                "categoryInfo"  => $categoryInfo,
            ]);
        }
    }
?>