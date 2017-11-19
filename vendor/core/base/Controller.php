<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 17:31
 */

namespace vendor\core\base;


abstract class Controller
{
    /**
     * текущий маршрут
     * @var array
     */
    public $route = [];
    /**
     * текущий вид
     * @var str
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * пользовательские данные
     * @var array
     */
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];

    }

    public function getView()
    {
        $vObj = new View($this->route,$this->layout,$this->view);
        $vObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }

}