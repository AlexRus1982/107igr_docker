<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\ActionsSystem;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class ApiController extends Controller
{

    public function index() {
        return response()->json([
            "server-answer" => "success",
            "text" => "api works" 
        ]);
    }

    public function getCategories() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_CategoriesList')
        ]);
    }

    public function getCategoryInfo(Request $request) {
        return ActionsSystem::Action('api_CategoryInfo', ['request' => $request]);
    }

    public function deleteCategory(Request $request) {
        return ActionsSystem::Action('api_deleteCategory', ['request' => $request]);
    }

    public function getCategoriesSimple() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_CategoriesListSimple')
        ]);
    }

    public function setCategoriesOrders(Request $request) {
        $time_start = microtime(true);
        ActionsSystem::Action('api_CategoriesOrders', ['request' => $request]);
        $time = microtime(true) - $time_start;
        
        return response()->json([
            "server-answer" => "success",
            "script-time"   => "{$time} секунд."
        ]);
    }

    public function getTags() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_TagsList')
        ]);
    }

    public function getApps() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_AppsList')
        ]);
    }

    public function getAppById(Request $request) {
        return response()->json([
            "server-answer" => "success",
            "app" => ActionsSystem::Action('api_AppById', [ 'id' => $request->id ]),
        ]);
    }

    public function setAppsActivity(Request $request) {
        ActionsSystem::Action('api_AppsActivity', ['request' => $request]);
        
        return response()->json([
            "server-answer" => "success",
        ]);
    }

    public function dataAppsUpdate(Request $request) {
        ActionsSystem::Action('api_AppsUpdate', ['request' => $request]);
        
        return response()->json([
            "server-answer" => "success",
        ]);
    }

    public function getPages() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_PagesList')
        ]);
    }

    public function getPageById(Request $request) {
        return response()->json([
            "server-answer" => "success",
            "page" => ActionsSystem::Action('api_PageById', [ 'id' => $request->id ]),
        ]);
    }

    public function dataPagesUpdate(Request $request) {
        ActionsSystem::Action('api_PagesUpdate', ['request' => $request]);
        
        return response()->json([
            "server-answer" => "success",
        ]);
    }

    public function getBlogs() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_BlogsList')
        ]);
    }

    public function getComments() {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_CommentsList')
        ]);
    }

    public function getQuestionsAndAnswers(Request $request) {
        return response()->json([
            "server-answer" => "success",
            "list" => ActionsSystem::Action('api_QuestionsAndAnswersList', ['request' => $request])
        ]);
    }

    public function setQuestionsAndAnswers(Request $request) {
        return ActionsSystem::Action('api_QuestionsAndAnswersSave', ['request' => $request]);
    }

    public function uploadImage(Request $request) {
        $data = $request->base64_data;
        $data = explode( ',', $data )[1];

        $data = base64_decode($data); // base64 decoded image data
        $source_img = imagecreatefromstring($data);
        $file = '/uploads/'. uniqid() . '.webp';
        imagewebp($source_img, $_SERVER["DOCUMENT_ROOT"] . $file);
        imagedestroy($source_img);

        return response()->json([
            "server-answer" => "success",
            "imagePath"     => $file,
        ]);
    }

    public function getAppsTags(Request $request) {
        return ActionsSystem::Action('api_AppLinks', ['request' => $request]);
    }

    public function deleteApp(Request $request) {
        return ActionsSystem::Action('api_deleteApp', ['request' => $request]);
    }


    #region GigaChat functions -----------------------------------------------------------------
    private function get($url, $header, $data, $json = false) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if ($json) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($curl);
        curl_close($curl);

        if ($json) {
            return json_decode($response, true);
        }

        return $response;
    }

    private function getToken() {
        
        $url = 'https://ngw.devices.sberbank.ru:9443/api/v2/oauth';
        
        // заголовки запроса
        $headers = [
            'Authorization: Bearer Zjk0MjcyMjQtMWJmOC00NTE2LTg4ZmItMmJiZmU2NDllZGY4Ojg5ZmEwNWVkLTdkODYtNDhhYi1hNmM5LWZhMGMxZWJlMmM4OQ==',
            'RqUID: 0d7e5b3c-b724-45ce-9d94-a7f4dc5c8a09',
            'Content-Type: application/x-www-form-urlencoded',
        ];

        // поля нашего запроса
        $data = [
            'scope'             => 'GIGACHAT_API_PERS',
        ];

        return $this->get($url, $headers, $data);
    }

    private function makeRewrite($content, $token) {
        $url = 'https://gigachat.devices.sberbank.ru/api/v1/chat/completions';

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        ];

        $data = [
            'model' => 'GigaChat:latest',
            'temperature' => 1.0,
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Ты — опытный копирайтер. Перепиши маркетинговый текст с учетом вида текста и выбранного стиля, с корректны форматированием."
                ],
                [
                    "role" => "user",
                    "content" => "Перепиши текст. Текст: " . $content,
                ],
            ],
        ];

        $response = $this->get($url, $headers, $data, true);
        return $response;
    }

    public function gigaChat(Request $request) {
        $response = $this->getToken();

        $token = json_decode($response, true)['access_token'];

        // logger($token);

        // $content = 'Благодаря новой LLM GigaChat лучше следует инструкциям и может выполнять более сложные задания: улучшилось качество суммаризации, рерайтинга и редактирования текстов, а ответы на вопросы стали точнее.\nПо результатам тестов новый GigaChat уже превзошел схожие по количеству параметров иностранные аналоги в бенчмарке MMLU.\nДостичь таких результатов получилось за счет множества экспериментов по улучшению модели и повышению эффективности ее обучения. В частности, команда использовала фреймворк для обучения больших языковых моделей с возможностью шардирования весов нейросети по видеокартам, что позволило сократить потребление памяти на них.\nВ числе первых доступ к API новинки получат бизнес-клиенты Сбера и участники академического сообщества.';

        $content = strip_tags($request->content);
        // logger($content);

        $response = $this->makeRewrite($content, $token);
        // logger(json_encode($response, true));

        return response()->json([
            "server-answer" => "success",
            "response"      => $response,
        ]);
    }
    #endregion GigaChat functions --------------------------------------------------------------

    public function cronStart(Request $request) {
        $app = DB::table('base')
        ->where('base.gen_desc', NULL)
        ->inRandomOrder()
        ->limit(1)
        ->first();

        $response = $this->getToken();
        $token = json_decode($response, true)['access_token'];
        $content = strip_tags($app->new_desc);
        $response = $this->makeRewrite($content, $token);

        if ($response != null){
            $gen_content = json_decode(json_encode($response))->choices[0]->message->content;
            $app->{'gen_desc'} = $gen_content;
    
            DB::table('base')
            ->where('id', $app->id)
            ->update(['gen_desc' => $gen_content]);

            return response()->json([
                "server-answer" => "success",
                "cron-result"   => "done",
                "logger"        => json_encode($response, JSON_UNESCAPED_UNICODE),
                "app"           => $app,
            ]);
        } else {
            return response()->json([
                "server-answer" => "error",
                "cron-result"   => "not done",
                "logger"        => json_encode($response, JSON_UNESCAPED_UNICODE),
                "app"           => null,
            ]);
        }
    }

    public function cronStartComment(Request $request) {
        $app = DB::table('base')
        ->inRandomOrder()
        ->limit(1)
        ->first();

        $names = [
            'Алексей Петрович',     'Андрей Сергеевич',     'Антон Михайлович',     'Роман Иванович',
            'Артем Владимирович',   'Борис Егорович',       'Василий Иванович',     'Владимир Сергеевич',
            'Григорий Иванович',    'Дмитрий Николаевич',   'Евгений Петрович',     'Егор Иванович',
            'Федор',                'Вася',                 'Петя',                 'Саша',
            'Неизвестный',          'Дядька',               'Ленусик',              'Оленька Петрова',
            'Вася Рогов',           'Димка',                'Геннадий',             'Юлька',
            'Илюшка Пушка',         'Дядя Вася',            'Дядя Федор',           'Матроскин',
            'Helen',                'Леночка',              'Ленусик',              'Alex',
            'Moris',                'Boris',                'Женечка',              'Тетя Клава',
            'Илья Михайлович',      'Кирилл Сергеевич',     'Максим Александрович', 'Михаил Петрович',
            'Николай Иванович',     'Олег Михайлович',      'Павел Сергеевич',      'Сергей Петрович',
            'Тимофей Иванович',     'Федор Иванович',       'Юрий Иванович',        'Яков Иванович',
            'Петр Иванович',        'Даниил Михайлович',    'Роман Сергеевич',      'Константин Михайлович',
            'Егор Петрович',        'Арсений Иванович',     'Степан Иванович',      'Семен Иванович',
            'Михаил Иванович',      'Леонид Иванович',      'Виктор Иванович',      'Евгений Иванович',
            'Алексей Иванович',     'Александр Иванович',   'Андрей Иванович',      'Владимир Иванович',
            'Дмитрий Иванович',     'Иван Иванович',        'Кирилл Иванович',      'Максим Иванович',
            'Олег Иванович',        'Павел Иванович',       'Сергей Иванович',      'Константин Иванович',
            'Даниил Иванович',      'Роман Иванович',       'Аноним'
        ];

        $response = $this->getToken();
        $token = json_decode($response, true)['access_token'];
        $content = strip_tags($app->new_desc);
        
        $url = 'https://gigachat.devices.sberbank.ru/api/v1/chat/completions';

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        ];

        $data = [
            'model' => 'GigaChat:latest',
            'temperature' => 1.0,
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Ты — опытный копирайтер. Перепиши маркетинговый текст с учетом вида текста и выбранного стиля, с корректны форматированием."
                ],
                [
                    "role" => "user",
                    "content" => "Используя данный текст напиши коментарий длиной от одного до десяти слов. Текст: " . $content,
                ],
            ],
        ];

        $response = $this->get($url, $headers, $data, true);

        $name = $names[array_rand($names)];

        if ($response != null){
            $gen_content = json_decode(json_encode($response))->choices[0]->message->content;
            $app->{'gen_comment'} = $gen_content;
            $app->{'gen_comment_name'} = $name;
    
            DB::table('comments')
            ->insert([
                'author'        => $name,
                'app_id'        => $app->id,
                'comment_text'  => $gen_content,
                'gen_giga'      => '1',
            ]);

            return response()->json([
                "server-answer" => "success",
                "cron-result"   => "done",
                "logger"        => json_encode($response, JSON_UNESCAPED_UNICODE),
                "app"           => $app,
            ]);
        } else {
            return response()->json([
                "server-answer" => "error",
                "cron-result"   => "not done",
                "logger"        => json_encode($response, JSON_UNESCAPED_UNICODE),
                "app"           => null,
            ]);
        }
    }

    #region UploadApp functions -----------------------------------------------------------------
    public function uploadStartApp(Request $request) {
        set_time_limit(0);
        // ini_set('memory_limit', '-1');

        // logger($request->upload_url);

        $upload_url = $request->upload_url;

        $upload_url_array = explode('/', $upload_url);
        // logger($upload_url_array);

        $lastPathElement = end($upload_url_array);
        // logger($upload_url);
        // $storagePath = "/storage/{$lastPathElement}/{$request->app_name}.apk";
        $storagePath = "storage/files/{$request->app_name}.apk";
        $storageLink = "https://files.107igr.ru/" . $storagePath;

        // $fileStreem = file_get_contents($upload_url, true);

        // Storage::disk('s3')->put("{$request->app_name}.apk", '23543465');
        // $content = Storage::disk('s3')->directories()/*->get('/test/test_text.txt')*/;

        $client = new S3Client([
            'region' => 'ru1',
            'version' => 'latest',
            'endpoint' => 'https://s3.ru1.storage.beget.cloud',
            'credentials' => [
                'key' => 'G54P7CRNF2CNGNXDRT09',
                'secret' => 'kAK4xRq3LSu5PDmgba0OOvjOg714RAVdWDX0oQrT',
            ],
            'use_path_style_endpoint' => true
        ]);
        
        $listResponse = $client->listBuckets();
        $buckets = $listResponse['Buckets'];
        foreach ($buckets as $bucket) {
            logger($bucket['Name'] . "\t" . $bucket['CreationDate'] . "\n");
        }

        #Получим объект
        $result = $client->getObject([
            'Bucket' => 'dc2b71e969f8-upright-natalia',
            'Key' => 'test/test_text.txt'
        ]);

        // logger($result['Body']->getContents());

        if (!file_exists($_SERVER["DOCUMENT_ROOT"] . '/uploads/tmpfiles')) {
            mkdir($_SERVER["DOCUMENT_ROOT"] . '/uploads/tmpfiles');
        }
        $tmpfname = tempnam($_SERVER["DOCUMENT_ROOT"] . "/uploads/tmpfiles", "upload_");

        $tempFile = fopen($tmpfname, "w") or die("Error: Unable to open file.");
        $fileContents = file_get_contents($upload_url);
        $tempFile = file_put_contents($tmpfname, $fileContents);

        $client->putObject([
            'Bucket'     => 'dc2b71e969f8-upright-natalia',
            'Key'        => $storagePath,
            'SourceFile' => $tmpfname,
        ]);

        DB::table('base')
        ->where('id', $request->app_id)
        ->update(['file_on_server' => $storageLink]);

        if (file_exists($tmpfname)) {
            unlink($tmpfname);
        }

        return response()->json([
            "server-answer" => "success",
            "upload-result" => "done",
            "upload-path"   => $storageLink, 
        ]);
    }

    public function uploadAppProgress(Request $request) {
        $file_url_size = curl_get_file_size( $request->upload_url );
        $file_dest_size = curl_get_file_size( $request->upload_dest );
        
        return response()->json([
            "server-answer" => "success",
            "url-size" => $file_url_size,
            "dest-size" => $file_dest_size,
        ]);
    }

    #endregion UploadApp functions --------------------------------------------------------------
}
