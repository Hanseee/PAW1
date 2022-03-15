<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>

<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h2 class="content-head is-center">Prosty kalkulator</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
	<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
		<fieldset>
                    
<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_x">Kwota: </label>
	<input id="id_x" type="text" name="x" value="<?php print($x); ?>" /><br />
	<label for="id_y">Na ile miesięcy: </label>
	<input id="id_y" type="text" name="y" value="<?php print($y); ?>" /><br />
 	<label for="id_z">Oprocentowanie (1-30)%: </label>
	<input id="id_z" type="text" name="z" value="<?php print($z); ?>" /><br />       
	<input type="submit" value="Oblicz kwotę" />
</form>	
</fieldset>
	</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">                    
<?php
//ile miesięcy, kwota i miejsce na wynik
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>
    
<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna kwota do spłaty: '.$result; ?><?php echo ' zł'?>
</div>
<?php } ?>
</div>
</div>

    
<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>