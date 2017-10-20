<?php
/**
* Basic
* Micro framework em PHP
*/
namespace Basic;

/**
* Classe Download
*/
class Download
{
    /**
    * Baixar arquivo através do método GET
    * @param  string  $url    URL do download
    * @param  boolean $agent  User agent
    * @param  boolean $cookie Cookies
    * @return string          Resposta RAW
    */
    public function get(string $url, string $agent=null, array $cookie=null):string
    {
        $ch = curl_init();
        if ($agent) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: ".$agent));
        }
        if ($cookie) {
            $cookie_string="";
            foreach ($cookie as $key => $value) {
                $cookie_string .= "$key=$value;";
            };
            curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    /**
    * Baixar arquivo através do método POST
    * @param  string  $url    URL da requisição
    * @param  boolean $params Parametros da requisição
    * @param  boolean $agent  User Agent da requisição
    * @param  boolean $cookie Cookies da requisição
    * @return string          Resposta RAW
    */
    public function post(string $url, array $params=null, array $agent=null, array $cookie=null):string
    {
        $ch = curl_init();
        if ($agent) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: ".$agent));
        }
        if ($cookie) {
            $cookie_string="";
            foreach ($cookie as $key => $value) {
                $cookie_string .= "$key=$value;";
            };
            curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        }
        if ($params) {
            $post_array = '';
            foreach ($params as $k => $v) {
                $post_array .= $k . '='.$v.'&';
            }
            $post_array = rtrim($post_array, '&');
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($post_array));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
