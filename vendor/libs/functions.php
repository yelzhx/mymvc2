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
    my_session_start();
    global $ses;

    $_SESSION[$key] = $value;
    $ses[$key]=$value;
    session_write_close();
}

function get_session($key){
    global $ses;
    if(isset($ses[$key])) {
        global $ses;

        return $ses[$key];
    }
    return false;
}

function my_session_start(){
    /*if(session_status()==PHP_SESSION_DISABLED) {
        session_start();
    }*/
    session_write_close();
    session_start();

}

function get_session_clear($key){
    global $ses;

    if(isset($ses[$key])) {
        global $ses;
        $sec=0;
        if(is_array($ses[$key])) {
            $value = $ses[$key][0];
            $sec = $ses[$key][1];
        }
        else{
            $value = $ses[$key];
        }
        my_session_start();
        unset($_SESSION[$key]);
        unset($ses[$key]);

        session_write_close();

        if($sec>0)
        sleep($sec);

        return $value;

    }

    return "";
}

function destroy_sessions(){
    my_session_start();
    session_destroy();
    session_write_close();
    global $ses;
    $ses=array();
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


function session_to_array(){
    my_session_start();
    global $ses;
    foreach($_SESSION as $key => $value){
        $ses[$key]=$value;
    }
    session_write_close();
    return $ses;
}