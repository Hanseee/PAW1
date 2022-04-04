<?php
namespace app\controllers;
// nie trzeba używać use kiedy kontroler używa klas niejawnie 
use app\forms\CalcForm;
use app\transfer\CalcResult;
class Kontroler {
    // kontroler testowy na bazie tego znalezionego na stronie P P Kudłacika
	private $form;
	private $result; 
	public function __construct(){
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
        
	public function getParams(){
		$this->form->x = getFromRequest('x');
		$this->form->y = getFromRequest('y');
		$this->form->z = getFromRequest('z');
	}
	
	public function validate() {
		if (! (isset ( $this->form->x ) && isset ( $this->form->y ) && isset ( $this->form->z ))) {
			return false;
		}

		if ($this->form->x == "") {
			getMessages()->addError('Nie podałeś kwoty');
		}
		if ($this->form->y == "") {
			getMessages()->addError('Nie podałeś liczby miesięcy');
		}
                if ($this->form->z == "") {
			getMessages()->addError('Oprocentowania');
		}
                 if ($this->form->z < 1) {
			getMessages()->addError('Oprocentowanie nie może być mniejsze od 1%');
		}
                 if ($this->form->z > 100) {
			getMessages()->addError('Oprocentowanie nie może być większe od 100%');
		}
		if (! getMessages()->isError()) {
			if (! is_numeric ( $this->form->x )) {
				getMessages()->addError('Pierwsza wartość nawet nie jest liczbą całkowitą');
			}
			if (! is_numeric ( $this->form->y )) {
				getMessages()->addError('Druga wartość nawet nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->z )) {
				getMessages()->addError('Trzecia wartość nawet nie jest liczbą całkowitą');
			}
		}
		return ! getMessages()->isError();
	}
    
        public function akcja(){
                $this->getparams();
                if ($this->validate()) {
                    $this->form->x = intval($this->form->x);
                    $this->form->y = intval($this->form->y);
                    $this->form->z = intval($this->form->z);
                    $this->result->result = ($this->form->x/$this->form->y)*($this->form->z/100);
                    getMessages()->addInfo('akcja() działa - obliczenia zwróciły wynik do $result');
                }
                $this->generateView();
            }
    
    public function generateView(){
		//nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
		// - wszystko załatwia funkcja getSmarty()
		
		getSmarty()->assign('page_title','phpproj1');
		getSmarty()->assign('page_description','walka z kontrolerem trwa nadal');
		getSmarty()->assign('page_header','Kontroler');
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		getSmarty()->display('Widok.tpl'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
