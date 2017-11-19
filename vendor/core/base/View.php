<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 18:42
 */

namespace vendor\core\base;


class View
{
    /**
    * текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route=$route;
        if($layout===false){
            $this->layout=false;
        }
        else{
            $this->layout=$layout ? : LAYOUT;
        }
        $this->view=$view;
    }

    public function render($vars)
    {
        if(is_array($vars)) {
            extract($vars);
        }
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(is_file($file_view)){
            require $file_view;
        }
        else{
            echo "<p>Не найден вид <b>{$file_view}</b></p>";
        }

        $content = ob_get_clean();

        if(false !== $this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout)){
                require $file_layout;
            }
            else{
                echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
            }
        }
        else{

        }


    }

}