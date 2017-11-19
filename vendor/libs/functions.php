<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 0:41
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
function debug($arr)
{
    echo '<pre>' . print_r($arr,true) . '</pre>';
}

function redirect($url = false)
{
    if($url){
        $redirect = $url;
    }
    else{
        $redirect = isset($_SESSION['HTTP_REFERER']) ? $_SESSION['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
}

function set_session($key, $value){
    session_write_close();
    session_start();
    $_SESSION[$key] = $value;
    session_write_close();
}

function get_session($key){
    if(isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    return "";
}

function get_session_clear($key){
    if(isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
        session_write_close();
        session_start();
        unset($_SESSION[$key]);
        session_write_close();
        return $value;
    }

    return "";
}

function destroy_sessions(){
    session_write_close();
    session_start();
    session_destroy();
    session_write_close();
}

function mlog_warning($name,$message){
    $log = new Logger($name);
    $log->pushHandler(new StreamHandler(ROOT.'/tmp/app.log', Logger::WARNING));
    $log->warning($message);
}

function mlog_error($name,$message){
    $log = new Logger($name);
    $log->pushHandler(new StreamHandler(ROOT.'/tmp/app.log', Logger::WARNING));
    $log->error($message);
}