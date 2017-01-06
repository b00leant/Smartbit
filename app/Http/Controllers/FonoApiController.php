<?php
    namespace App\Http\Controllers;
    
    use GuzzleHttp\Exception\GuzzleException;
    use GuzzleHttp\Client;
    use Illuminate\Http\Request;
    
    class FonoApiController extends Controller{
        public function listByModel($model){
            $client->request('GET', '/foo.js', [
                'headers'        => ['Accept' => 'application/json'],
                'decode_content' => false
            ]);
        }
    }
?>