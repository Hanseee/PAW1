{extends file="main.tpl"}
{block name=footer}przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora{/block}

{block name=content}

<h2 class="content-head is-center">Prosty kalkulator kreytowy</h2>

<div class="pure-g">
    
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">  
    {* ja będę szczery, nie mam najmniejszego pojęcia jak wycentrować diva w purecss więc wkładam pusty blok 2/5 *}
</div>   
    
<div class="l-box-lrg pure-u-1 pure-u-med-1-5">
	<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
            <fieldset>
            <label for="id_x">Kwota: </label>
            <input id="id_x" type="text" name="x" value="{$form->x}" /><br />
            <label for="id_y">Na ile miesięcy: </label>
            <input id="id_y" type="text" name="y" value="{$form->y}" /><br />
            <label for="id_z">Oprocentowanie (1-30)%: </label>
            <input id="id_z" type="text" name="z" value="{$form->z}" /><br />       
            <button type="submit" class="pure-button">Oblicz</button>	
            </fieldset>
	</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-2-5"> 

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Miesięczna kwota do spłaty:</h4>
	<p class="res">
	{$res->result}
	</p>
{/if}

</div>
</div>

{/block}