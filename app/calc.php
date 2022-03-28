<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

function getParams(&$form){
	$form['x'] = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$form['y'] = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$form['z'] = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
}

function validate(&$form,&$infos,&$msgs,&$hide_intro){
        if ( ! (isset($form['x']) && isset($form['y']) && isset($form['z']) ))	{return false;}	
	$hide_intro = true;
	$infos [] = 'Przekazano parametry.';
        if ( $form['x'] == "") {$msgs [] = 'Nie podano kwoty';}
        if ( $form['y'] == "") {$msgs [] = 'Nie podano czasu';}
        if ( $form['z'] == "") {$msgs [] = 'Nie podano oprocentowania';}
	if ( count($msgs)==0 ) {
                if (! is_numeric( $form['x'] )) {$msgs [] = 'Kwota wartość nie jest liczbą';}
                if (! is_numeric( $form['y'] )) {$msgs [] = 'Data nie jest poprawna';}
                if (! is_numeric( $form['y'] )) {$msgs [] = 'Oprocentowanie nie jest liczbą';}
	}
        if (count($msgs)>0) {return false;}
        else {return true;}
}

function process(&$form,&$infos,&$msgs,&$result){
	$form['x'] = intval($form['x']);
	$form['y'] = intval($form['y']);
	$form['z'] = intval($form['z']);
        $result = ($form['x']/$form['y'])*($form['z']/100);
}



$form = null;
$infos = array();
$messages = array();
$result = null;
$hide_intro = false;
	

getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();
$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');
$smarty->assign('hide_intro',$hide_intro);
//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.tpl');