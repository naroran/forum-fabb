<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-xs-2"></div>
<div class="col-xs-8">
    <ul class="breadcrumb">
    <li><a href="<?=base_url('home')?>">Home</a></li>
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('help/bbcode/')?>"><?=$bread?></a></li>
    </ul>
		  <h4>Aide Bbcode</h4>
		  
          <br>
		  <p style="color: #6B6B6B; text-align:justify;">
          <b>1- Qu’est-ce que le BBCode ?</b><br>
    Le BBCode n'est pas un langage de programmation, est une simple implémentation spéciale qui est utilisée à la place du Html.
    
     <p style="color: #6B6B6B; text-align:justify;">Le plus souvent sur les page web qui offrent l'interactivité entre l'internaute et le site web en question utilisent le bbcode pour laisser un message, rédiger un avis, répondre à un sondage et j'en passe. Les domaines d'utilisation du bbcode sont multiples.
     On utilise le bbcode essentiellement pour formater son texte.
     <p style="color: #6B6B6B; text-align:justify;">Permettre ou interdire le bbcode dans les formulaires revient à la décision du webmaster (le propriétaire du site web).
      
     <p style="color: #6B6B6B; text-align:justify;">Comme on vient de le dire, le bbcode ressemble au HTML, les balises sont entre deux (2) paires de crochets <strong>[balise-ouvrante]</strong> un contenu d'élément <strong>[balise-fermante]</strong>, cette syntaxe ressemble à &lt;p&gt; un texte &lt;/p&gt;.
     
     <p style="color: #6B6B6B; text-align:justify;">Sur le forum fabb, l'utilisation du bbcode est permise avec le strict minimum de balise.<br>
     <b>2- comment utiliser le bbcode</b><br>
     Vous pouvez rédiger votre texte dans son intégralité, une fois vous avez terminé, vous pouvez procéder à son formatage. Vous sélectionnez le mot ensuite vous cliquez sur la balise souhaitée.<br>
     Avant de cliquer sur envoyer ou valider selon le formulaire sur lequel vous &ecirc;tes, cliquez sur preview pour voir comment votre texte sera formaté.
     <p style="color: #6B6B6B; text-align:justify;">Remarque importante :: certains crochets possèdent le symbole <b>=</b>, cela veut dire que c'est un attribut, vous insérez directement après le signe <b>=</b> le contenu de l'attribut sans espace après <b>=</b>.

     
     <p style="color: #6B6B6B; text-align:justify;">
     <b>3- Exemple de formatage ::</b><br>
     Par exemple, je sélectionne la phrase suivante :: <span style="background-color:#6699FF">Mon texte en gras</span> et je clique sur <strong>B</strong>. Le texte sélectionné se mettra automatiquement entre les crochets
 <strong>[B] et [/B]</strong>.
 <p style="color: #6B6B6B;">Le m&ecirc;me principe est appliqué aux autres balises. 
     <table class="table table-responsive table-striped table-bordered">
     <tr>
     <th>Exemple</th>
     <th>Balise</th>
     <th>Rendu</th>
     </tr>
     <tr>
     <td>Texte gras</td>
     <td>[b] texte en gras [/b]</td>
     <td><p><b>texte en gras</b></td>
     </tr>
     <tr>
     <td>Texte souligné</td>
     <td>[u-line] texte souligné [/u-line]</td>
     <td><span style="text-decoration: underline;"><p>texte souligné</span></td>
     </tr>
     <tr>
     <td>Texte barré</td>
     <td>[barre] texte barré [/barre]</td>
     <td><span style=" text-decoration:line-through;"><p>texte barré</span></td>
     </tr>
     <tr>
     <td>Aligné à gauche</td>
     <td>[left] texte à gauche [/left]</td>
     <td><p style="text-align:left !important;"> texte à gauche <br>
     <i style="font-size:.9em">(ce texte est aligné à gauche de la cellule)</i></td>
     </tr> 
     <tr>
     <td>Texte justifié</td>
     <td>[justify] texte justifié [/justify]</td>
     <td><p style="text-align:center !important;"> texte justifié 
     <br><i style="font-size:.9em">(ce texte est centré et justifié à la cellule)</i></td>
     </tr> 
     <tr>
     <td>Texte aligné à droite</td>
     <td>[right] texte aligné à droite [/right]</td>
     <td><p style="text-align:right !important;"> texte aligné à droite 
     <br><i style="font-size:.9em">(ce texte est aligné à droite de cette cellule)</i></td>
     </tr> 
     <tr>
     <td>Alias URL</td>
     <td>[url=https://www.forum-fabb.com] fabb [/url]</td>
     <td><p><a href="https://www.forum-fabb.com">fabb</a></td>
     </tr>
     <tr>
     <td>Ancre(anchor)</td>
     <td>[anchor] https://www.google.com [/anchor]</td>
     <td><p><a href="https://www.google.com">https://www.google.com</a></td>
     </tr>    
     <tr>
     <td>Adresse email</td>
     <td>[email=truc@server.DTL] contactez-moi [/email]</td>
     <td><p><a href="mailto:truc@server.DTL">contactez-moi</a>     
     <br><i style="font-size:.9em">(déclenchera le client de  méssagerie de l'internaute.)</i></td>
     </tr> 
     <tr>
     <td>Insérer une image</td>
     <td>[img] lien de votre image [/img]</td>
     <td>
          <p>Remarque sur les images :: <br>
     <i style="font-size:.9em">1- Sur fabb les images seront redimentionnées à 300px de longueur x 200px de hauteur.<br>
     2- l'image doit avoir absolument un lien absolu, c-à-d vous ne pouvez pas insérer une image depuis votre machine.</i>
     </td>
     </tr>
     <tr>
     <td>Insérer quote</td>
     <td>[quote=auteur] inserez votre citation ici [/quote]</td>
     <td>
      <p>Remarque ::<br>
      <i style="font-size:.9em">Quote est une balise un peu différente des autres balises.<br>
     Elle lui sera ajouté automatiquent un peu de style. Remplacez le mot "auteur" par celui qui a cité l'expression.<br>
     Exemple ::<br>
     [quote=le japonais] le client est roi. [/quote] affichera ::<br>
     le japonais dit :: le client est roi
     </td>
     </tr> 
     <tr>
     <td>Insérer un code </td>
     <td>[code=] votre bout de code [/code]</td>
     <td> <p>Remarque ::<br>
     <i style="font-size:.9em">Après le signe "=", sans laisser d'espace indiquez le type de script que vous voulez inserer.<br> par exemple php.<br>
     [code=php]<br>
if(isset($myvar)){<br>

echo 'la variable'. $myvar .' existe';<br>
}<br>
[/code]</i><br>
Ce code affichera<br>
&lt;?php<br>
if(isset($myvar)){<br>

echo 'la variable'. $myvar .' existe';<br>
}?&gt;<br>
     </td>
     </tr>                                      
     </table>
 <b>4- Insérer emoji :: </b>A l'endroit ou vous souhaitez insérer smiley , cliquez sur l'emoji de votre choix. Il sera ajouté au texte automatiquement.</b><br>    
     <br><br>
     <p> <b>5- icones indicatives :: </b>En plus de ce que a été expliqué ci-dessus concernant le bbcode, sur le forum existent des icones qui permettent au membre de se retrouver facilement entre les sujets consultés et non consultés. Avant tout, il faut &ecirc;tre connecté pour voir ces icones. La signification de chaqu'une de ces icones est comme suit::
      <p><img src="<?=base_url('assets/img/msgin_lu.png') ?>" alt="message lu"> :: Le <b>IN</b> signifie que vous avez participé dans la discussion de ce topic et vous avez consulté tout les méssages.
     <p> <img src="<?= base_url('assets/img/msgin_non_lu.png') ?>" alt="message non lu"> :: Le <b>IN</b> signifie que vous avez participé dans la discussion de ce topic et il y a des nouveaux messages depuis votre dernière consultation.
     <p> <img src="<?= base_url('assets/img/msgout_lu.png')?>" alt="message non lu"> :: Le <b>out</b> signifie que vous n'avez pas participé dans la discussion de ce topic et vous avez déjà consulté tout les méssages de ce topic.
     <p> <img src="<?= base_url('assets/img/msgout_non_lu.png')?>" alt="message non lu"> :: Le <b>out</b> signifie que vous n'avez pas participé dans la discussion de ce topic et il y a dedans des méssages que vous n'avez pas consulté.
     <p> <img src="<?= base_url('assets/img/msg_deja_lu.png')?>" alt="message non lu"> :: Vous avez déjà consulté tout les méssages privés re&ccedil;us 
     <p> <img src="<?=base_url('assets/img/msg_non_lu.png')?>" alt="message non lu"> :: Vous avez des méssages privés que vous n'avez pas encore consulté 
     <br><br>
		  <hr>
          <p class="text-center"><a href="<?= $this->agent->referrer();?>" class="btn btn-primary btn-sm btn-block">Retour</a></p>
          <hr>
        </div>  
 <div class="col-xs-2"></div>         
</div>
</div>