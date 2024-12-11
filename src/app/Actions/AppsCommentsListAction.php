<?php
    namespace App\Actions;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    #[ActionFor('AppsCommentsList')]
    class AppsCommentsListAction extends ActionClass {

        public function handle($args) {
            ['app_id' => $appId] = $args;

            $comments = DB::table('comments')
            ->where('app_id', $appId)
            ->orderBy('id')
            ->get();

            $comments_map = array();
            foreach ($comments as $comment) {
                $now = new \DateTime();
                $commentTime = new \DateTime($comment->date_time);
                $timeDiff = $now->diff($commentTime);

                $timeMain = null;
                $timeKeys = ['y', 'm', 'd', 'h', 'i', 's'];
                foreach ($timeKeys as $key) {
                    if ($timeDiff->{$key} > 0) {
                        $timeMain = $key;
                        break;
                    }
                }

                $timeData = [
                    's' => ['секунд', 'секунду', 'секунды', 'секунды', 'секунды', 'секунд', 'секунд', 'секунд', 'секунд', 'секунд'],
                    'i' => ['минут', 'минуту', 'минуты', 'минуты', 'минуты', 'минут', 'минут', 'минут', 'минут', 'минут'],
                    'h' => ['часов', 'час', 'часа', 'часа', 'часа', 'часов', 'часов', 'часов', 'часов', 'часов'],
                    'd' => ['дней', 'день', 'дня', 'дня', 'дня', 'дней', 'дней', 'дней', 'дней', 'дней'],
                    'm' => ['месяцев', 'месяц', 'месяца', 'месяца', 'месяца', 'месяцев', 'месяцев', 'месяцев', 'месяцев', 'месяцев'],
                    'y' => ['лет', 'год', 'года', 'года', 'года', 'лет', 'лет', 'лет', 'лет', 'лет']
                ];

                if ($timeMain) {
                    $timeValue = $timeDiff->{$timeMain};
                    $valueString = ($timeValue > 10 && $timeValue < 20) ?
                    $timeData[$timeMain][0] : $timeData[$timeMain][$timeValue % 10];

                    $comment->date_time = "{$timeValue} {$valueString} назад";
                } else {
                    $comment->date_time = '';
                }

                $comments_map["{$comment->id}"] = $comment;
                $comments_map["{$comment->id}"]->{"children"} = array();
            }

            $hierarchy = [];
            foreach ($comments_map as $comment) {
                if ($comment->answer_parent_id == -1) {
                    $hierarchy["{$comment->id}"] = $comment;
                } else {
                    array_push($comments_map["{$comment->answer_parent_id}"]->{"children"}, $comment);
                }
            }

            $hierarchy = json_decode(json_encode($hierarchy), true);

            // dump($comments_map);
            // dd($hierarchy);

            return [ 
                'hierarchy' => $hierarchy, 
                'count'     => $comments->count(), 
            ];
        }
    }
?>