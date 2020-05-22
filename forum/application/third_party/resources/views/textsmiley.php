<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="bouton_bbcode" style="border-radius:5px; padding-bottom:1px !important; max-width:93%;">
<div id="smiley">
<p style="margin-left:5px"><img class=" btn-default btn-xs" alt="emoji" title="cliquez pour choisir un emoji" height="30" width="30" src="<?=base_url('assets/smiley/soleil.gif')?>"></p>
</div>
<div id="smilies">
<table>
<tr>
<th></th>
</tr>
<tr>
<td>
<img  src="<?=base_url('assets/smiley/pingouins.gif')?>" height="20" width="20"  title="pingouins" alt="pingouins"
onclick="addBalises('#message', '[Ping]', null);" /></td>
<td><img height="25" width="25" src="<?=base_url('assets/smiley/triste.gif')?>" title="Triste" alt="Triste"
onclick="addBalises('#message','[Tri]', null);" /></td>
<td><img height="25" width="25" src="<?=base_url('assets/smiley/amours.gif')?>" title="Amours" alt="Amours"
onclick="addBalises('#message','[Amr]', null);" /></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/love.gif')?>" title="love" alt="love"
onclick="addBalises('#message','[love]', null);"></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/chien.gif')?>" title="chien" alt="chien"
onclick="addBalises('#message','[chien]', null)" /></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/chat.gif')?>" title="chat" alt="chat"
onclick="addBalises('#message','[chat]', null);"/></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/soleil.gif')?>" title="soleil" alt="soleil"
onclick="addBalises('#message','[sol]', null);"/></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/banana.gif')?>" title="banana" alt="banana"
onclick="addBalises('#message','[ban]', null);"/></td>
<td><img height="25" width="25" src="<?=base_url('assets/smiley/militaire.gif')?>" title="militaires" alt="Militaires"
onclick="addBalises('#message','[Mil]', null);" /></td>
<td class="emoti">
<img height="25" width="25" src="<?=base_url('assets/smiley/tourne_soleil.gif')?>" title="tourne_soleil" alt="tourne_soleil"
onclick="addBalises('#message','[tour_sol]', null);"/></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/canada.gif')?>" title="canada" alt="canada"
onclick="addBalises('#message','[cad]', null);"/></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/nager.gif')?>" title="nager" alt="nager"
onclick="addBalises('#message','[nag]', null);"/></td>
<td class="emoti"><img height="25" width="25" src="<?=base_url('assets/smiley/danger.gif')?>" title="danger" alt="danger"
onclick="addBalises('#message','[dan]', null);"/></td>
<td class="emoti">
<img height="25" width="25" src="<?=base_url('assets/smiley/attention.gif')?>" title="attention" alt="attention"
onclick="addBalises('#message','[att]', null);"/></td>
<td><img height="25" width="25" src="<?=base_url('assets/smiley/mefiant.gif')?>" title="mefiant" alt="mefiant"
onclick="addBalises('#message','[mef]', null);"/></td>

</tr>  
</table>                   
</div>
</div>

