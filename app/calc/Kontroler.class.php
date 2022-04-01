<?php
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';
require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/alerty.php';

class Kontroler {
    private $msgs;   //wiadomości dla widoku
    private $form;   //dane formularza (do obliczeń i dla widoku)
    private $result; //inne dane dla widoku
    private $hide_intro;
    
        public function __construct() {
            $this->form = new CalcForm();   //konstruktor trzeba pisać z palca bo robi głupoty
            $this->msgs = new alerty();
            $this->result = new CalcResult();
            $this->hide_intro = false;
        }
    
        public function getParams(){
            $this->form->x = isset($_REQUEST ['x']) ? $_REQUEST ['x'] : null;
            $this->form->y = isset($_REQUEST ['y']) ? $_REQUEST ['y'] : null;
            $this->form->z = isset($_REQUEST ['z']) ? $_REQUEST ['z'] : null;
        }

    
        public function validate() {
		if (! (isset ( $this->form->x ) && isset ( $this->form->y ) && isset ( $this->form->z ))) {
			return false;
		} else { 
			$this->hide_intro = true;
		}
		if ($this->form->x == "") {
			$this->msgs->addError('Nie podano liczby 1');
		}
		if ($this->form->y == "") {
			$this->msgs->addError('Nie podano liczby 2');
		}
                if ($this->form->z == "") {
			$this->msgs->addError('Nie podano liczby 3');
		}
		if (! $this->msgs->isError()) {
			if (! is_numeric ( $this->form->x )) {
				$this->msgs->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->y )) {
				$this->msgs->addError('Druga wartość nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->z )) {
				$this->msgs->addError('Druga wartość nie jest liczbą całkowitą');
			}
		}
		return ! $this->msgs->isError();
	}
    
        public function akcja(){
                $this->getparams();
                if ($this->validate()) {    //jeśli przeszło sprawdzenie w valdiate() (zwraca true)
                    $this->form->x = intval($this->form->x);
                    $this->form->y = intval($this->form->y);
                    $this->form->z = intval($this->form->z);
                    $this->result->result = ($this->form->x/$this->form->y)*($this->form->z/100);
                    $this->msgs->addInfo('Wykonano obliczenia.');
                }
                $this->generateView();
            }
    
    public function generateView(){
		global $conf;
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		$smarty->assign('page_title','phpzadanie1uno');
		$smarty->assign('page_description','Aplikacja z jednym "punktem wejścia". Model MVC, w którym jeden główny kontroler używa różnych obiektów kontrolerów w zależności od wybranej akcji - przekazanej parametrem.');
		$smarty->assign('page_header','Kontroler główny');		
		$smarty->assign('hide_intro',$this->hide_intro);
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		$smarty->display($conf->root_path.'/app/calc/Widok.html');
	}
}
