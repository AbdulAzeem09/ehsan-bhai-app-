<?php 
   session_start();
   include "../../common.php";
   require_once '../library/config.php';
   require_once '../library/functions.php';
   require '../../library/openai/vendor/autoload.php';
   
   if(isset($_SESSION['userId']))
   {
   
   // Get API key in tbl_user table in user_id bases
   $userid=$_SESSION['userId'];
   $data = selectQ("select * from tbl_user where user_id=?","s",[$userid],"one");
    $apikey=$data['ai_keys'];
   
   // $content=$_POST['chat_contant'];
   $content =  isset($_POST['chat_contant']) ?  $_POST['chat_contant'] : "";
   // ChatAPI Code Start
   
        $userQuery = isset($_POST['user_query']) ? $_POST['user_query'] : '';
           $openaiApiKey =   $apikey;
           $gpt3Endpoint = 'https://api.openai.com/v1/chat/completions';
           $httpClient = new \GuzzleHttp\Client();
   
           $messages = [
               ['role' => 'user',
                'content' => $content
            ],
           ];
   
         try {
       $response = $httpClient->post($gpt3Endpoint, [
           'headers' => [
               'Content-Type' => 'application/json',
               'Authorization' => 'Bearer ' . $openaiApiKey,
           ],
           'json' => [
               'model' => 'gpt-3.5-turbo',
               'messages' => $messages,
           ],
       ]);
   } catch (\GuzzleHttp\Exception\RequestException $e) {
       echo 'Guzzle RequestException: ' . $e->getMessage();
   }
           $data = json_decode($response->getBody(), true);
           echo $reply = $data['choices'][0]['message']['content'];
   
   
   
   }
   
   ?>