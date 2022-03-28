<?php
require_once dirname(__FILE__).'/../config.php';
require_once $conf->root_path.'/app/Kontroler.class.php';

$ctrl = new Kontroler();   //po utworzeniu kontrolera od razu go używamy
$ctrl->akcja();
