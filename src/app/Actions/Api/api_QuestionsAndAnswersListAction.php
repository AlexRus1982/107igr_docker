<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('api_QuestionsAndAnswersList')]
    class api_QuestionsAndAnswersListAction extends ActionClass {

        public function handle($args) {
            ['request' => $request] = $args;
            
            $app_id = $request['app_id'];
            if ($app_id){
                $questions_and_answers = DB::table('questions_and_answers')
                ->where('qa_app_id', $app_id)
                ->get()
                ->toArray();
            }
            else {
                $questions_and_answers = DB::table('questions_and_answers')
                ->get()
                ->toArray();
            }

            return $questions_and_answers;
        }
    }
?>