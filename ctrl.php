<?php
require_once 'init.php';
switch ($action) {
	default :
            //teraz autoloader sam znajduje pliki, w starej formie wyrzuca błąd: Class "Kontroler" not found 
		$ctrl = new app\controllers\Kontroler();
		$ctrl->generateView ();
	break;
        
	case 'calcCompute' :
		$ctrl = new app\controllers\Kontroler();
		$ctrl->akcja ();
	break;
    
	case 'action1' :
		print('start');
	break;
    
	case 'action2' :
		print('koniec');
	break;
}