<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.
// 1. pobranie parametrów
$x = $_REQUEST ['x']; //kwota
$y = $_REQUEST ['y']; //miesiące
$z = $_REQUEST ['z']; //oprocentowanie
// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($x) && isset($y) && isset($z))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}
// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $x == "") {
	$messages [] = 'Nie podano kwoty';
}
if ($y == "") {
	$messages [] = 'Nie podano czasu';
}
if ($z == "") {
	$messages [] = 'Nie podano oprocentowania';
}
if ($z < 1){
        $messages [] = 'Niepoprawne oprocentowanie';
}
if ($z > 30){
        $messages [] = 'Niepoprawne oprocentowanie';
}

// 3. wykonaj zadanie jeśli wszystko w porządku
if (empty ( $messages )) { // gdy brak błędów	
	//konwersja parametrów na int
	$x = intval($x);
	$y = intval($y);
	$z = intval($z);
        $result = ($x/$y)*($z/100);
}
// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';