<?php
    namespace App\Actions;

    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_CategoriesOrders')]
    class api_CategoriesOrdersAction extends ActionClass {

        public function handle($args) {
            
            ['request' => $request] = $args;

            // logger($request->categoryType);
            // logger($request->orders);

            foreach ($request->orders as $order) {
                DB::table('categories')
                ->where('main_url', $request->categoryType)
                ->where('id', $order['category_id'])
                ->update(['order' => $order['category_order']]);
            }

            return true;
        }
    }
?>