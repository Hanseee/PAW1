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
		$this->form->kwota = getFromRequest('kwota');
		$this->form->mc = getFromRequest('mc');
		$this->form->procent = getFromRequest('procent');
	}
	
	public function validate() {
		if (! (isset ( $this->form->kwota ) && isset ( $this->form->mc ) && isset ( $this->form->procent ))) {
			return false;
		}

		if ($this->form->kwota == "") {
			getMessages()->addError('Nie podałeś kwoty');
		}
		if ($this->form->mc == "") {
			getMessages()->addError('Nie podałeś liczby miesięcy');
		}
                if ($this->form->procent == "") {
			getMessages()->addError('Oprocentowania');
		}
                 if ($this->form->procent < 1) {
			getMessages()->addError('Oprocentowanie nie może być mniejsze od 1%');
		}
                 if ($this->form->procent > 100) {
			getMessages()->addError('Oprocentowanie nie może być większe od 100%');
		}
		if (! getMessages()->isError()) {
			if (! is_numeric ( $this->form->kwota )) {
				getMessages()->addError('Pierwsza wartość nawet nie jest liczbą całkowitą');
			}
			if (! is_numeric ( $this->form->mc )) {
				getMessages()->addError('Druga wartość nawet nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->procent )) {
				getMessages()->addError('Trzecia wartość nawet nie jest liczbą całkowitą');
			}
		}
		return ! getMessages()->isError();
	}
        
        public function action_akcja(){
                $this->getparams();
                if ($this->validate()) {
                    $this->form->kwota = intval($this->form->kwota);
                    $this->form->mc = intval($this->form->mc);
                    $this->form->procent = intval($this->form->procent);
                    $this->result->result = ($this->form->kwota/$this->form->mc)*($this->form->procent/100);
                    getMessages()->addInfo('akcja() działa - obliczenia zwróciły wynik do $result');
                }
                    try {    
                    $database = new \Medoo\Medoo([
                    'type' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'simpledb',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'collation' => 'utf8_polish_ci',
                    'port' => 3306,
                    'prefix' => 'PREFIX_',
                    'logging' => true,
                    'error' => PDO::ERRMODE_SILENT,
                    'option' => [
                            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ],
                            'command' => [
                                    'SET SQL_MODE=ANSI_QUOTES'
                            ]
                    ]);
                    $database->insert("wynik", [
                        "kwota" => $this->form->kwotac,
                        "mc" => $this->form->mc,
                        "procent"  => $this->form->procent,
                        "result"  => $this->result->result
                    ]); 
                    }catch (\PDOException $ex) {getMessages()->addError("DB Error: ".$ex->getMessage());}
		$this->generateView();
	}
	
	public function action_calcShow(){
		getMessages()->addInfo('Witaj w kalkulatorze');
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
