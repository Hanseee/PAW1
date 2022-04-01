<?php
require_once dirname (__FILE__).'/../config.php';

//1. pobierz nazwę akcji

$action = $_REQUEST['action'];

//2. wykonanie akcji
switch ($action) {
	default :
		include_once $conf->root_path.'/app/calc/Kontroler.class.php';
		$ctrl = new Kontroler ();
		$ctrl->generateView ();
	break;
	case 'calcCompute' :
		include_once $conf->root_path.'/app/calc/Kontroler.class.php';
		$ctrl = new Kontroler ();
		$ctrl->akcja ();
	break;
	case 'action1' :
	break;
	case 'action2' :
	break;
}