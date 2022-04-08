<?php
require_once 'init.php';
getRouter()->setDefaultRoute('calcShow');
getRouter()->setLoginRoute('login');
getRouter()->addRoute('calcShow',    'Kontroler',  ['user','admin']);
getRouter()->addRoute('calcCompute', 'Kontroler',  ['user','admin']);
getRouter()->addRoute('login',       'LoginCtrl');
getRouter()->addRoute('logout',      'LoginCtrl', ['user','admin']);
getRouter()->go();