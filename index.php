<?php

//index.php to pierwszy plik który jest uruchamiany na serwerze

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/'); //dostajemy sie do sciezki którą skierowała do nas przeglądarka, pozbywamy sie 1-wszego slasha
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController'); //w momencie wywolania URL index otwieramy metode index z DefaultController
Routing::get('index', 'DefaultController'); //w momencie wywolania URL index otwieramy metode index z DefaultController
Routing::get('signUp', 'DefaultController');
Routing::get('addCustomMed', 'UsersMedicationsController');
Routing::get('addMed', 'UsersMedicationsController');
Routing::get('homePage', 'UsersMedicationsController');
Routing::get('startPage', 'DefaultController');
Routing::get('logout', 'DefaultController');
Routing::get('dosageSchedule', 'UsersMedicationsController');
Routing::get('account', 'UserController');
Routing::get('yourMedications', 'UsersMedicationsController');
Routing::get('adminPanel', 'UserController');
Routing::get('settings', 'NotificationController');


Routing::post('login', 'SecurityController');
Routing::post('signUp', 'SecurityController');
Routing::post('addCustomMed', 'UsersMedicationsController');
Routing::post('addMed', 'UsersMedicationsController');
Routing::post('dosageSchedule', 'UsersMedicationsController');
Routing::post('showMedsToCategory', 'MedicationController');
Routing::post('showUsersMedicationsToCurrentDay', 'UsersMedicationsController');
Routing::post('changePhoto', 'UserController');
Routing::post('changeUsername', 'UserController');
Routing::post('changeName', 'UserController');
Routing::post('deleteMedication', 'UsersMedicationsController');
Routing::post('setAllAsRead', 'UsersMedicationsController');
Routing::post('addMedToDatabase', 'MedicationController');
Routing::post('changeNotificationSetting', 'NotificationController');


Routing::run($path);