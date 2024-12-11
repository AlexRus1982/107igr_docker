<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_QuestionsAndAnswersSave')]
    class api_QuestionsAndAnswersSaveAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;

            foreach ($request['list'] as $item) {
                if ($item['id'] != NULL && $item['deleted']== false) {

                    $app = DB::table('questions_and_answers')
                    ->where('qa_id', $item['id'])
                    ->update([
                        'qa_q'      => $item['question'],
                        'qa_a'      => $item['answer'],
                        'qa_order'  => $item['order']
                    ]);
                }

                if ($item['id'] != NULL && $item['deleted']) {

                    $app = DB::table('questions_and_answers')
                    ->where('qa_id', $item['id'])
                    ->delete();
                }

                if ($item['id'] == NULL && $item['deleted'] == false) {

                    $app = DB::table('questions_and_answers')
                    ->insert([
                        'qa_app_id' => $request['app_id'],
                        'qa_q'      => $item['question'],
                        'qa_a'      => $item['answer'],
                        'qa_order'  => $item['order']
                    ]);
                }
            }

            return response()->json([
                "server-answer" => "success",
            ]);
        }
    }
?>