<?php
use Firebase\JWT\JWT;
class Session
{

    public function __construct(public string $time)
    {
    }

}
class SessionManager{
    public static string $SECRET_KEY = "sdfsdfdsfdsfdsfdsfdsfds";
    private static string $PASSWORD = "lhoweslulus";

    public static function login($pwd){
        if ($pwd == SessionManager::$PASSWORD){
            $payload = [
                "logged" => time(),
            ];
            $jwt = \Firebase\JWT\JWT::encode($payload, SessionManager::$SECRET_KEY, 'HS256');
            setcookie("X-FRWL-SESSION",$jwt,time()+60*60*5);
            return true;
        }else{
            return false;
        }
    }
    public static function getCurrentSession(): Session
    {
        if(isset($_COOKIE['X-FRWL-SESSION'])){
            $jwt = $_COOKIE['X-FRWL-SESSION'];
            try {
                $payload = \Firebase\JWT\JWT::decode($jwt, SessionManager::$SECRET_KEY, ['HS256']);
                return new Session(time: $payload->logged);
            }catch (Exception $exception){
                throw new Exception("User is not login");
            }
        }else{
            throw new Exception("User is not login");
        }
    }
}