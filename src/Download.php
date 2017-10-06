<?php
namespace Basic;
class Download{
    function get($url,$agent=false,$cookie=false){
        $ch = curl_init();
        if($agent){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: ".$agent));
        }
        if($cookie){
            $cookie_string="";
            foreach( $cookie as $key => $value ) {
                $cookie_string .= "$key=$value;";
            };
            curl_setopt($ch,CURLOPT_COOKIE, $cookie_string);
        }
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    function post($url,$params=false,$agent=false,$cookie=false){
        $ch = curl_init();
        if($agent){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: ".$agent));
        }
        if($cookie){
            $cookie_string="";
            foreach( $cookie as $key => $value ) {
                $cookie_string .= "$key=$value;";
            };
            curl_setopt($ch,CURLOPT_COOKIE, $cookie_string);
        }
        if($params){
            $postData = '';
            //create name value pairs seperated by &
            foreach($params as $k => $v)
            {
                $postData .= $k . '='.$v.'&';
            }
            $postData = rtrim($postData, '&');
        }
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
        curl_setopt($ch,CURLOPT_MAXREDIRS,3);//only 3 redirects
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
