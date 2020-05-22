<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div style="border-radius:5px; padding:8px 2px !important; max-width:93%;">
<table>
<tr>
<td>
<button data-html="true" data-toggle="tooltip" title="<strong>Exemple Gras ::</strong><br>[B] forum-fabb[/B]" class="btn btn-sm" id="gras" name="gras" onclick="addBalises('#message', '[b]', '[/b]');"><?= $this->config->item('bold')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Souligné ::</strong><br>[u-line] forum-fabb [/u-line]" class="btn btn-sm" id="sline" name="sline" onclick="addBalises('#message','[u-line]', '[/u-line]')"><?= $this->config->item('underline')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Mot barré ::</strong><br>[barre] forum-fabb [/barre]"  class="btn btn-sm" id="barre" name="barre" onclick="addBalises('#message','[barre]', '[/barre]')"><?= $this->config->item('strik')?></button> </td>
<td><span style="font-size:20px">|</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Texte aligné à gauche ::</strong><br>[left] forum-fabb [/left]" class="btn btn-sm" id="left" name="left" onclick="addBalises('#message','[left]', '[/left]')"><?= $this->config->item('left')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Texte justifié ::</strong><br>[justify] forum-fabb [/justify]" class="btn btn-sm" id="justify" name="justify" onclick="addBalises('#message','[justify]', '[/justify]')"><?= $this->config->item('justify')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Texte aligné à droite  ::</strong><br>[right] forum-fabb [/right]" class="btn btn-sm" id="right" name="right" onclick="addBalises('#message','[right]', '[/right]')"><?= $this->config->item('right')?></button> </td>
<td><span style="font-size:20px">|</span></td>
<td><button data-html="true" data-toggle="tooltip" data-toggle="tooltip" title="<strong>Exemple URL ::</strong><br>[url]https://www.forum-fabb.com/[/url]" class="btn btn-sm" id="url" name="url" onclick="addBalises('#message','[url=]', '[/url]')"><?= $this->config->item('url')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Lien cliquable ::</strong><br>[anchor= https://www.forum-fabb.com/]forum-fabb[/anchor]"  class="btn btn-sm" id="anchor" name="anchor" onclick="addBalises('#message','[anchor=]', '[/anchor]')"><?= $this->config->item('anchor')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple Insérrer un email ::</strong><br>[mail=truc@domaine.com] contactez-moi[/mail]"  class="btn btn-sm" id="mail" name="mail" onclick="addBalises('#message','[email=]', '[/email]')"><?= $this->config->item('mail')?></button></td>
<td><span style="font-size:20px">|</span></td>

<td><button data-html="true" data-toggle="tooltip" title="<strong>Insérrer une image ::</strong><br>[img]lien absolu de l'image [/img]" class="btn btn-sm" id="img" name="img" onclick="addBalises('#message','[img]', '[/img]')"><?= $this->config->item('img')?></button></td>
<td><span>&nbsp;</span></td>

<td><button data-html="true" data-toggle="tooltip" title="<strong>Exemple quote ::</strong><br>[quote=nom de la source]le texte du quote[/quote]" class="btn btn-sm" id="quote" name="quote" onclick="addBalises('#message','[quote=auteur]', '[/quote]')"><?= $this->config->item('quote')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="<strong>Code informatique ::</strong><br>[code=php]votre code[/code]" class="btn btn-sm" id="code" name="code" onclick="addBalises('#message','[code=]', '[/code]')"><?= $this->config->item('code')?></button></td>
<td><span>&nbsp;</span></td>
<td><button data-html="true" data-toggle="tooltip" title="Consultez en détail et avec des exemples comment utiliser le bbcode" class="btn btn-sm" id="aide" name="aide" onClick="location.href='<?=base_url('help/index')?>'"><?= $this->config->item('help')?></button>
</td></tr>
</table>
</div>