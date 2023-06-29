<?php

namespace App\Base\Request;

class Request implements IRequest{
    private $body = [];
    public $httpHost, $documentRoot;
    public $remoteAddr, $remotePort;
    public $serverSoftware, $serverProtocol, $serverName, $serverPort;
    public $requestUri, $requestMethod, $requestTime_float, $requestTime;
    public $scriptName, $scriptFilename;
    public $phpSelf, $httpUser_agent, $httpSec_fetchSite;
    public $httpConnection, $httpUpgrade_insecure_requests;
    public $httpSec_fetch_mode, $httpSec_fetch_dest;
    public $httpAccept, $httpAccept_language, $httpAccept_encoding;
    // public $get, $post, $result;

    function __construct(){
        $this->bootstrapSelf();
    }

    private function bootstrapSelf(){
        /**
         * $_SERVER=[
         *  http_host => "127.0.0.1"
         * ]
         * 
         * 
         */

        foreach($_SERVER as $key => $value){
            // $this->httpHost
            $this->{$this->toCamelCase($key)} = $value;
        }

    }

   
    private function toCamelCase($string){
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach($matches[0] as $match){
            $c = str_replace('_','',strtoupper($match));
            $result = str_replace($match, $c, $result);

            return $result;
        }
    }

    

    public function getBody(){
        if($this->requestMethod === "GET"){
            return [];
        }

        if($this->requestMethod == "POST"){
            $this->body = array();
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $this->body;
        }
    }


    public function get($name = ''){
        if(empty($this->body)) $this->body = $this->getBody();
        $body = $this->body;
        if(empty($name))
            return "";
        if(isset($body[$name])){
            # code
            return $body[$name];
        }
        return "";

    }

}
