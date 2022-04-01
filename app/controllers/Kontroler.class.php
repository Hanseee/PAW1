<?php
require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';
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
			getMessages()->addError('Nie podano liczby 1');
		}
		if ($this->form->y == "") {
			getMessages()->addError('Nie podano liczby 2');
		}
                if ($this->form->z == "") {
			getMessages()->addError('Nie podano liczby 3');
		}
		if (! getMessages()->isError()) {
			
			if (! is_numeric ( $this->form->x )) {
				getMessages()->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->y )) {
				getMessages()->addError('Druga wartość nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->z )) {
				getMessages()->addError('Druga wartość nie jest liczbą całkowitą');
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
                    getMessages()->addInfo('Wykonano obliczenia.');
                }
                $this->generateView();
            }
    
    public function generateView(){
		//nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
		// - wszystko załatwia funkcja getSmarty()
		
		getSmarty()->assign('page_title','Przykład 06a');
		getSmarty()->assign('page_description','Aplikacja z jednym "punktem wejścia". Zmiana w postaci nowej struktury foderów, skryptu inicjalizacji oraz pomocniczych funkcji.');
		getSmarty()->assign('page_header','Kontroler główny');
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		getSmarty()->display('Widok.html'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
