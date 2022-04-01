<?php
require_once 'init.php';
switch ($action) {
	default :
		include_once 'app/controllers/Kontroler.class.php';
		$ctrl = new Kontroler ();
		$ctrl->generateView ();
	break;
	case 'calcCompute' :
		include_once 'app/controllers/Kontroler.class.php';
		$ctrl = new Kontroler ();
		$ctrl->akcja ();
	break;
	case 'action1' :
		print('hello');
	break;
	case 'action2' :
		print('goodbye');
	break;
}