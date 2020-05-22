<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bbcode
{
	protected static $bbcodeBalises;
	
	protected static $htmlBalises;
	
	public static function bbcodeToHtml($content)
	{
		$content = stripslashes(htmlspecialchars(nl2br($content)));
		BBCode::initializeBbcodeToHtml();
		for ($i = 0 ; $i < count(self::$bbcodeBalises) ; $i++) {
			$content = preg_replace(self::$bbcodeBalises[$i], self::$htmlBalises[$i], $content);
		}
		return $content;
	}
	public static function htmlToBbcode($content)
	{
		$content = stripslashes(htmlspecialchars(nl2br($content)));
		BBCode::initializeHtmlToBbcode();
		for ($i = 0 ; $i < count(self::$htmlBalises) ; $i++) {
			$content = preg_replace(self::$htmlBalises[$i], self::$bbcodeBalises[$i], $content);
		}
		return nl2br($content);
	}
	protected static function initializeBbcodeToHtml()
	{
		self::$bbcodeBalises = array('#\[sous_titre](.+)\[/sous_titre]#isU',
									 '#\[p](.+)\[/p]#isU',
									 '#\[br]#isU',
									 '#\[i](.+)\[/i]#isU',
									 '#\[b](.+)\[/b]#isU',
									 '#\[liste]#isU',
									 '#\[/liste]#isU',
									 '#\[liste_element]#isU',
									 '#\[/liste_element]#isU');

		self::$htmlBalises = array('<h2>$1</h2>',
								   '<p>$1</p>',
								   '<br />',
								   '<em>$1</em>',
								   '<strong>$1</strong>',
								   '<ul>',
								   '</ul>',
								   '<li>',		
								   '</li>');		
	}
	protected static function initializeHtmlToBbcode()
	{
		self::$htmlBalises = array('#\<h2>(.+)\</h2>#isU',
								   '#\<p>(.+)\</p>#isU',
								   '#\<em>(.+)\</em>#isU',
								   '#\<strong>(.+)\</strong>#isU',
								   '#\<ul>(.+)\</ul>#isU',
								   '#\<li>(.+)\</li>#isU');
											  
		self::$bbcodeBalises = array('[sous_titre]$1[/sous_titre]',
									 '[p]$1[/p]',
									 '[i]$1[/i]',
									 '[b]$1[/b]',
									 '[ul]$1[/ul]',
									 '[li]$1[/li]');	
	}
public function netcode($texte)
{
$texte = str_replace('[Ping]','<img src="'.base_url('assets/smiley/pingouins.gif').'" title="Pingouins" alt="Pingouins">',$texte);
$texte = str_replace('[Amr]', '<img src="'.base_url('assets/smiley/amours.gif').'" title="Amours" alt="Amours" />',$texte);
$texte = str_replace('[Tri]', '<img src="'.base_url('assets/smiley/triste.gif').'" title="Triste" alt="Triste" />',$texte);
$texte = str_replace('[Mil]', '<img src="'.base_url('assets/smiley/militaire.gif').'" title="Militaires" alt="Militaires" />', $texte);
$texte = str_replace('[love]', '<img src="'.base_url('assets/smiley/love.gif').'" title="love" alt="love" />', $texte);
$texte = str_replace('[chien]', '<img src="'.base_url('assets/smiley/chien.gif').'" title="chien" alt="chien" />', $texte);
$texte = str_replace('[chat]', '<img src="'.base_url('assets/smiley/chat.gif').'" title="chat" alt="chat" />', $texte);
$texte = str_replace('[sol]', '<img src="'.base_url('assets/smiley/soleil.gif').'" title="soleil" alt="soleil" />',$texte);
$texte = str_replace('[tour_sol]', '<img src="'.base_url('assets/smiley/tourne_soleil.gif').'" title="tourne_soleil" alt="tourne_soleil" />',$texte);
$texte = str_replace('[att]', '<img src="'.base_url('assets/smiley/attention.gif').'" title="attention" alt="attention" />',$texte);
$texte = str_replace('[ban]', '<img src="'.base_url('assets/smiley/banana.gif').'" title="banana" alt="banana" />',$texte);
$texte = str_replace('[cad]', '<img src="'.base_url('assets/smiley/canada.gif').'" title="canada" alt="canada" />',$texte);
$texte = str_replace('[dan]', '<img src="'.base_url('assets/smiley/danger.gif').'" title="danger" alt="danger" />',$texte);
$texte = str_replace('[mef]', '<img src="'.base_url('assets/smiley/mefiant.gif').'" title="mefiant" alt="mefiant" />',$texte);
$texte = str_replace('[nag]', '<img src="'.base_url('assets/smiley/nager.gif').'" title="nager" alt="nager" />',$texte);
$texte = preg_replace('#\[b\](.*?)\[/b\]#isU', '<strong>$1</strong>',$texte);
$texte = preg_replace('#\[i\](.*?)\[/i\]#isU', '<em>$1</em>',$texte);
$texte = preg_replace('#\[u-line\](.*?)\[/u-line\]#isU', '<span style="text-decoration:underline;">$1</span>', $texte);
$texte = preg_replace('#\[barre\](.*?)\[/barre\]#isU', '<span style="text-decoration:line-through">$1</span>', $texte);
$texte = preg_replace('#\[left\](.*?)\[/left\]#isU', '<p style="text-align:left">$1</p>',$texte);
$texte = preg_replace('#\[center\](.*?)\[/center\]#isU', '<p style="text-align:center">$1</p>',$texte);
$texte = preg_replace('#\[right\](.*?)\[/right\]#isU', '<p style="text-align:right">$1</p>',$texte);
$texte = preg_replace('#\[justify\](.*?)\[/justify\]#isU', '<p style="text-align:justify">$1</p>',$texte);
$texte =preg_replace('#\[url\](.*?)\[/url\]#isU','<a href="$1" target="_blank">$1</a>',$texte);
$texte= preg_replace('#\[anchor=(.*?)\](.+?)\[\/anchor]#i','<a href="$1" target="_blank">$2</a>',$texte);
$texte= preg_replace('#\[email=(.*?)](.*?)\[\/email]#i','<a href="mailto:$1">$1</a>',$texte);
$texte = preg_replace('#\[power\](.*?)\[/power\]#is', '<sup>$1</sup>',$texte);
$texte = preg_replace('#\[indice\](.*?)\[/indice\]#is', '<sub>$1</sub>',$texte);
$texte = preg_replace('#\[img\](.*?)\[\/img\]#isU', '<img width="300" height="200" src="$1" alt="Image" />',$texte);
$texte = preg_replace('#\[taille=(.*?)\](.*)\[/taille\]#Usi', "<h$1>$2</h$1>",$texte);
$texte = preg_replace('#\[police=(.*?)\](.+)\[/police\]#Usi', '<span style="font-family:$1;">$2</span>',$texte);
$texte = preg_replace('#\[couleur=(.*)\](.*)\[/couleur\]#Usi', '<span style="color:$1;">$2</span>',$texte);
$texte = preg_replace('`\[quote=(.*?)\](.*?)\[/quote\]`isU', '<div class="quotemoti"><strong>'.ucfirst('$1').' dit ::</strong> $2</div>', $texte);
$texte = preg_replace('`quoteauteur=([a−z0−9A−Z.−]+)(.*?)/quote`isU', '<div class="quoteAuteur">Auteur : $1 <br> $2 </div>',$texte);
$texte = preg_replace('#\[code=(.*?)\](.*?)\[/code\]#isU', '&lt;$1&gt; $2 &lt;/$1&gt;', $texte);

return $texte;
}

public function initialcode($texte)
{//Smileys
$texte = str_replace('<img src="'.base_url('assets/smiley/pingouins.gif').'" title="Pingouins" alt="Pingouins">','[Ping]',$texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/amours.gif').'" title="Amours" alt="Amours" />','[Amr]',$texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/triste.gif').'" title="Triste" alt="Triste" />','[Tri]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/militaire.gif').'" title="Militaires" alt="Militaires" />','[Mil]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/love.gif').'" title="love" alt="love" />','[love]',  $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/chien.gif').'" title="chien" alt="chien" />','[chien]',  $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/chat.gif').'" title="chat" alt="chat" />','[chat]',  $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/soleil.gif').'" title="soleil" alt="soleil" />','[sol]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/tourne_soleil.gif').'" title="tourne_soleil" alt="tourne_soleil" />','[tour_sol]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/attention.gif').'" title="attention" alt="attention" />','[att]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/banana.gif').'" title="banana" alt="banana" />','[ban]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/canada.gif').'" title="canada" alt="canada" />','[cad]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/danger.gif').'" title="danger" alt="danger" />','[dan]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/mefiant.gif').'" title="mefiant" alt="mefiant" />','[mef]', $texte);
$texte = str_replace('<img src="'.base_url('assets/smiley/nager.gif').'" title="nager" alt="nager">','[nag]', $texte);
$texte = preg_replace('<strong>(.*?)</strong>','#\[b\]$1\[/b\]#isU', $texte);
$texte = preg_replace('<em>(.*?)</em>','#\[i\]$1\[/i\]#isU', $texte);
$texte = preg_replace('<span style="text-decoration:underline;">(.*?)</span>','#\[u-line\]$1\[/u-line\]#isU',  $texte);
$texte = preg_replace('<span style="text-decoration:line-through">(.*?)</span>','#\[barre\]$1\[/barre\]#isU',  $texte);
$texte = preg_replace('<p style="text-align:left">(.*?)</p>','#\[left\]$1\[/left\]#isU', $texte);
$texte = preg_replace('<p style="text-align:center">(.*?)</p>','#\[center\]$1\[/center\]#isU', $texte);
$texte = preg_replace('<p style="text-align:right">(.*?)</p>','#\[right\]$1\[/right\]#isU', $texte);
$texte = preg_replace('<p style="text-align:justify">(.*?)</p>','#\[justify\]$1\[/justify\]#isU', $texte);
$texte =preg_replace('<a href="(.*?)" target="_blank">(.*?)</a>','#\[url\]$1\[/url\]#isU',$texte);
$texte= preg_replace('<a href="(.*?)" target="_blank">(.+?)</a>','#\[link=$1\]$2\[\/link]#i',$texte);
$texte= preg_replace('<a href="mailto:(.*?)">(.*?)</a>','#\[email=$1]$1\[\/email]#i',$texte);
$texte = preg_replace('#\[power\](.*?)\[/power\]#is', '<sup>$1</sup>',$texte);
$texte = preg_replace('#\[indice\](.*?)\[/indice\]#is', '<sub>$1</sub>',$texte);
$texte = preg_replace('<img width="300" height="200" src="(.*?)" alt="Image" />','#\[img\]$1\[\/img\]#is', $texte);
$texte = preg_replace('#\[taille=(.*?)\](.*)\[/taille\]#Usi', "<h$1>$2</h$1>",$texte);
$texte = preg_replace('#\[police=(.*?)\](.+)\[/police\]#Usi', '<span style="font-family:$1;">$2</span>',$texte);
$texte = preg_replace('#\[couleur=(.*)\](.*)\[/couleur\]#Usi', '<span style="color:$1;">$2</span>',$texte);
$texte = preg_replace('<div class="quotemoti"><strong>'.ucfirst('(.*?)').' dit ::</strong> (.*?)</div>','`\[quote=$1\]$2\[/quote\]`isU',  $texte);
$texte = preg_replace('`quoteauteur=([a−z0−9A−Z.−]+)(.*?)/quote`isU', '<div class="quoteAuteur">Auteur : $1 <br> $2 </div>',$texte);
$texte = preg_replace('#&lt;(.*?)&gt; (.*?) &lt;/(.*?)&gt;#','#\[code=$1\]$2\[/code\]#isU',  $texte);
return $texte;
}
}
