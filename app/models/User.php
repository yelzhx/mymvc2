<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 19:59
 */

namespace app\models;

class User extends \vendor\core\base\Model
{
    public $table = 'users';
    public $id;
    public $username;
    public $password;
    public $amount;
    public $is_active;
    public static function login()
    {
        $username = !empty(trim($_POST["username"])) ? trim($_POST["username"]) : null;
        $password = !empty(trim($_POST["password"])) ? trim($_POST["password"]) : null;
        if($username && $password){
            $model = new User();
            $user = $model->findOne($username,'username','\app\models\User');
            if($user){
                //echo "$username $password {$user->username} {$user->password}";
                $md5hash=md5($password);
                if($md5hash == $user->password){
                    $_SESSION['user']['id']=$user->id;
                    return $user;
                    /*foreach ($user as $key => $value){
                        if($key != 'password') {
                        //    $_SESSION['user'][$key] = $value;
                        }
                    }*/
                    return true;
                }

            }
        }
        return false;
    }

    public static function getUserInfo()
    {
        $id = 0;
        if (isset($_SESSION['user']['id'])) {
            $id = (int)$_SESSION['user']['id'];
            $model = new User();
            $user = $model->findOne($id, 'id', '\app\models\User');
            if ($user) {
                return $user;
            }
        }
        return false;
    }

    public function getMoney(){
        $money = !empty(trim($_POST["get_money"])) ? (int)trim($_POST["get_money"]) : 0;
        if($money>0){
            $user = self::getUserInfo();
            $balance = $user->amount-$money;
            if($balance>=0){
                if($this->query("update users set amount=? where id=?",[$balance, $user->id])) {
                    return [true, "$money тенге успешно выведены"];
                }
            }

        }
        return [false, "Произошла ошибка вовремя вывода $money тенге"];

    }

}