<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ErrorController.php';
require_once 'src/controllers/UsersMedicationsController.php';
require_once 'src/controllers/MedicationController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/NotificationController.php';

class Routing 
{
    public static $routes; //tablica przechowująca URL oraz ścieżkę kontrolera który zostanie otwarty

    public static function get($url, $view) { 
        //metoda wstawiająca do tej tablicy kontroler przydzielony do odpowiedniego URL
        self::$routes[$url] = $view;
    }

    public static function post($url, $view){
        self::$routes[$url] = $view;
    }

    public static function run($url){
        $action = explode("/", $url)[0]; //rozdzielamy url na elementy pomiędzy "/" i wyciągamy tylko pierwszy (indeks 0 tablicy)
        
        if(!array_key_exists($action, self::$routes)){
//            //sprawdzamy czy pierwszy element z url znajduje się w tablicy routes
            $errorController = new ErrorController();
            $errorController->handleNotFound();
            return;
        }
        
        $controller = self::$routes[$action]; //pobieramy nazwe controllera z tablicy routes za pomocą klucza action
        $object = new $controller; //tworzymy obiekt kontrolera (pod zmienną $controller bedzie znajdowal sie string na ktorego podstawie tworzymy object)
        $action = $action ?: 'index';

        $object->$action();
    }
}