<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('AppQuestionsAndAnswersList')]
    class AppQuestionsAndAnswersListAction extends ActionClass {

        public function handle($args) {
            ['app_id' => $appId] = $args;
            
            $questions_and_answers = DB::table('questions_and_answers')
            ->where('qa_app_id', $appId)
            ->get()
            ->toArray();

            return $questions_and_answers;
        }
    }
?>