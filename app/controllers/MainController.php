<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 16:11
 */

namespace app\controllers;

use app\models\User;


class MainController extends \vendor\core\base\Controller
{
    //public $layout="your_layout"; //для задания своего шаблона

    public function indexAction()
    {

        // create a log channel
        if(!empty($_POST)){

            $user = new User();
            $money_got = $user->getMoney();
            if($money_got[0]){
                set_session('success', $money_got[1]);
                redirect();
            }
            else{
                set_session('error', [$money_got[1],10]);

                redirect();

            }
        }
        $user = User::getUserInfo();
        if($user){
            $title = "Главная страница";
            $header = "Домашняя страница";
            $username = $user->username;
            $amount = $user->amount;

            $this->set(compact('title', 'header', 'username', 'amount'));
        }
        else{
            redirect('/main/login');
        }
        // add records to the log
        //$log->warning('Foo');
        //$log->error('Bar');
        /*$model = new User();
        $user = $model->findOne('user1', 'username');
        debug($user);*/
    }

    public function loginAction()
    {

        //$this->layout=false;//если не нужно подключать шаблон
        $title = "Страница авторизации";
        $header = "Страница авторизации";
        $this->set(compact('title','header'));
        // create a log channel

        if(!empty($_POST)){
            //$user = new User();
            $user = User::login();

            if($user){
                set_session('success', 'Вы успешно авторизаваны!');
                $u=['id' => $user->id, 'username' => $user->username, 'amount' => $user->amount];
                set_session('user',$u);
                redirect();
            }
            else{
                set_session('error', 'Логин и пароль введены неверно!');
                mlog_warning('login', 'Неудачная попытка авторизоваться'); // использование MONOLOG функция из functions.php
                redirect('/main/login');
            }

        }
        else{
            $user = User::getUserInfo();
            if($user){
                redirect();
            }
        }


    }

    public function logoutAction(){
        destroy_sessions();
        redirect();
    }
}