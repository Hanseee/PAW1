{extends file="main.tpl"}
{block name=footer}footer tekst akcja{/block}

{block name=content}
<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>
<h2 class="content-head is-center">Prosty kalkulator kreytowy</h2>

<div class="pure-g">
    
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">  
    {* ja będę szczery, nie mam najmniejszego pojęcia jak wycentrować diva w purecss więc wkładam pusty blok 2/5 *}
</div>   
    
<div class="l-box-lrg pure-u-1 pure-u-med-1-5">
	<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
            <fieldset>
            <label for="id_kwota">Kwota: </label>
            <input id="id_kwota" type="text" name="kwota" value="{$form->kwota}" /><br />
            <label for="id_mc">Na ile miesięcy: </label>
            <input id="id_mc" type="text" name="mc" value="{$form->mc}" /><br />
            <label for="id_procent">Oprocentowanie (1-30)%: </label>
            <input id="id_procent" type="text" name="procent" value="{$form->procent}" /><br />       
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