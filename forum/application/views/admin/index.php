<?php
/**
* fabb is an open source application developed within codeigniter framework
*
* This content is released under the GNU General Public License version 3
*
* Copyright (c) 2018 - 2020, faci abdelhafid bulletin board :: fabb
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see https://www.gnu.org/licenses/
*
* The GNU General Public License does not permit incorporating your program
* into proprietary programs.  If your program is a subroutine library, you
* may consider it more useful to permit linking proprietary applications with
* the library.  If this is what you want to do, use the GNU Lesser General
* Public License instead of this License.  But first, please read
* https://www.gnu.org/licenses/why-not-lgpl.html
*
* @see commercial  use doc/commercial.txt
* @package	Fabb  application web community
* @author	faci abdelhafid <admin@forum-fabb.com>
* @subpackage Controllers
* @copyright	Copyright (c) 2018 - 2020, fabb <https://www.forum-fabb.com/>
* @link	<https://forum-fabb.com/contact>
* @since	Version 1.7.19
* @filesource
*/
if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="row">
        <br>
        <div class="col-md-3">
            <!-- column1, Vertical Dropdown Menu -->
            <div id="main-menu" class="list-group">
                <a href="<?= base_url('admin/index/' . $this->idM) ?>" class="list-group-item active">Dashbord</a>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                
    <a href="#sub-menu-10" class="list-group-item active" data-toggle="collapse" data-parent="#main-menu">Configuration
    <span style=" float:right;" class="caret"></span></a>
                
  <div class="collapse list-group-level1" id="sub-menu-10">
  <a href="<?= base_url('admin/config/'.$this->idM) ?>" class="list-group-item" data-parent="#sub-menu-10">Général</a>
  <a href="<?= base_url('admin/add_img/'.$this->idM)?>" class="list-group-item" data-parent="#sub-menu-10">Image forum</a> 
  <a href="<?= base_url('admin/add_logo/'.$this->idM)?>" class="list-group-item " data-parent="#sub-menu-10">Logo forum</a>  </div>
  <div style="height:2px; width:auto; color:#B8B350;"></div>
                

     
<a href="#sub-menu" class="list-group-item active" data-toggle="collapse" data-parent="#main-menu">Catégorie 
     <span style=" float:right;" class="caret"></span></a>
               
<div class="collapse list-group-level1" id="sub-menu">
<a href="<?= base_url('admin/all_cat/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu">Consulter</a>
<a href="<?= base_url('admin/add_cat/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu">Ajouter</a>
<a href="<?= base_url('admin/select_cat/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu">Editer</a>
<a href="<?= base_url('admin/del_cat/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu">Supprimer</a>
<a href="<?= base_url('admin/select_ord_cat/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu">Changer l'ordre</a></div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                
               
<a href="#sub-menu-2" class="list-group-item active" data-toggle="collapse" data-parent="#main-menu">Forums 
<span style=" float:right;" class="caret"></span></a>

<div class="collapse list-group-levhel1" id="sub-menu-2">
<a href="<?= base_url('admin/all_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Consulter</a>
<a href="<?= base_url('admin/add_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Ajouter</a>
<a href="<?= base_url('admin/select_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Editer</a>
<a href="<?= base_url('admin/move_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-3">Déplacer</a>
<a href="<?= base_url('admin/select_ord_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Changer l'ordre</a>
<a href="<?= base_url('admin/select_droit_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Droits sur les forums</a>
<a href="<?= base_url('admin/delete_forum/' . $this->idM) ?>" class="list-group-item" data-parent="#sub-menu-2">Supprimer</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                
                <a href="#sub-menu-3" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Topic <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-3">
                    <a href="<?= base_url('admin/consulter_topic/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-3">Consulter</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-4" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Membres
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-4">
                    <a href="<?= base_url('admin/members_list/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Liste Des membres </a>
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/profil') ?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Consulter/editer</a>
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/avatar') ?>" class="list-group-item"
                        data-parent="#sub-menu-4">Update Avatar</a>
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/droit') ?>" class="list-group-item"
                        data-parent="#sub-menu-4">Droit du Membre</a>
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/bann') ?>" class="list-group-item"
                        data-parent="#sub-menu-4">Bannir</a>
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/delete') ?>" class="list-group-item"
                        data-parent="#sub-menu-4">Supprimer</a>
                    <a href="<?= base_url('admin/list_bann/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Liste Bannis</a>
                    <a href="<?= base_url('admin/inactif/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Membres inactifs</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-5" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Mots vulgaires
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-5">
                    <a href="<?= base_url('admin/add_badwords/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-5">
                        Ajouter Mot Vulgaire </a>
                    <a href="<?= base_url('admin/badwords/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-5">
                        Gerer Mots Vulgaire </a> </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-6" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Smtp
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-6">
                    <a href="<?= base_url('admin/add_smtp/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-6">
                        Ajouter </a>
                    <a href="<?= base_url('admin/select_smtp/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-6"> Editer </a> <a
                        href="<?= base_url('admin/active_smtp/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-6">
                        Activer smtp</a>
                    <a href="<?= base_url('admin/test_email/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-6">
                        Test Méssage</a></div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-7" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Messageries <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-7">
                    <a href="<?= base_url('admin/select_member/' . $this->idM . '/mail/') ?>" class="list-group-item"
                        data-parent="#sub-menu-7">Envoi simple </a>
                    <a href="<?= base_url('admin/masse_mail/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-7">
                        Envoi En Masse</a>
                    <a href="<?= base_url('admin/abus_report/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-7">
                        Rapport d'abus</a> </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-8" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Monétisation <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-8">
                    <a href="<?= base_url('admin/pub/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-8">
                        Ajouter une Pub </a>
                    <a href="<?= base_url('admin/gerer_pub/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-8">
                        Gerer Pub </a> </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-9" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Robots
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-9">
                    <a href="<?= base_url('admin/gerer_robots/' . $this->idM) ?>" class="list-group-item"
                        data-parent="#sub-menu-9">
                        Gerer Robots </a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="<?= base_url('admin/statistic/' . $this->idM) ?>" class="list-group-item active">Statistic
                </a>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="<?= base_url('users/deconnexion') ?>" class="list-group-item active">Déconnexion
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <?php
switch ($render) {
case 'configuration':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">configuration</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Configuration Générale du Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, vous pouvez configurer les différentes options du forum ainsi
                                vos préférences .<br>
                                les champs qui peuvent avoir une inclarté sont dotés d'une infos-bulle vous explicant
                                d'avantage sur le champ
                                en question.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
$config_name = array(
"avatar_maxsize" => "Poid maximal en (octet) de l'avatar",
"avatar_maxh" => "Hauteur maximale de l'avatar",
"avatar_maxw" => "Largeur maximale de l'avatar",
"signat_strlen" => "Nombre de caractère d'une signature",
"auth_bbcode" => '<span data-html="true" data-toggle="tooltip" title="Il est fortement recommandé d\'autoriser le bbcode.<br>Valeur par défaut est :: oui.<br>Valeur possible :: <b>oui / non</b>" >Autorisation du bbcode</span> <span style="color:red"> *</span>',
"auth_smiley" => '<span data-html="true" data-toggle="tooltip" title="Ajoutez-vous un peu de l\'humour aux posts des
membres...?<br>Valeur par défaut est :: oui.<br>Valeur possible :: <b>oui / non</b>">Autorisation smiley</span> <span
style="color:red"> *</span>',
"pseudo_maxsize" => "caractères max. du pseudo",
"pseudo_minsize" => "caractères min. du pseudo",
"topic_par_page" => "Nombre de topics par page",
"post_par_page" => "Nombre de posts par page",
"admin_topic_par_page" => "Nbr topic par page (admin page)",
"temps_flood" => '<span data-html="true" data-toggle="tooltip" title="Empecher les membres de recharger leurs
navigateurs à
fin de prévenir votre base de donnée.<br> temps exprimé en seconde">Temps anti-flood</span><span style="color:red"> *
</span>',
"badword_par_page" => '<span data-html="true" data-toggle="tooltip" title="Concerne l\'affichage du nombre des mots
vulgaires
par page dans les pages d\'aministration.">Nombre mots vulgaires Par Page</span> <span style="color:red"> *</span>',
"forum_titre" => "Titre du forum",
"slogan_1" => '<span data-html="true" data-toggle="tooltip" title="Vous trouverez d\'avantage explications en suivant
le lien
<br> <b>Image du forum</b>">Premier slogan du forum</span><span style="color:red"> *</span>',
"slogan_2" => '<span data-html="true" data-toggle="tooltip" title="Vous trouverez d\'avantage explications en suivant le
lien
<br> <b>Image du forum</b>">Deuxième slogan du forum</span> <span style="color:red"> *</span>',
"members_par_page" => '<span data-html="true" data-toggle="tooltip" title="Concerne l\'affichage du nombre des membres
par page dans les pages d\'aministration.">Membres par page</span><span style="color:red"> *</span>',
"admin_email" => '<span data-html="true" data-toggle="tooltip" title="L\'email du l\'administrateur est obligatoire.<br>
Si non vous risquez de voir pas mal de problèmes sur vos pages.">Email Administrateur</span><span style="color:red"> *</span>',
"search_par_page" => "Resultats de recherche par page",
"lien_linkedin" => "Lien vers le reseau Linkedin",
"lien_twitter" => "Lien vers le reseau Twitter",
"lien_facebook" => "Lien vers le reseau facebook",
"raison_sociale" => '<span data-html="true" data-toggle="tooltip" title="Votre raison social.<br>Si non, renseigner votre
nom ou prénom">Indiquez votre raison sociale</span><span style="color:red"> *</span>',
"website_title" => "Titre de votre site",
"periode_inactif" => '<span data-html="true" data-toggle="tooltip" title="periode d\'inactivité du membre sur le forum,
exprimée en mois">Durée d\'inactivité du membre </span><span style="color:red"> *</span>',
"admin_topic_par_page" => '<span data-html="true" data-toggle="tooltip" title="Nombre de topic dans les page
administration.">    Topic par page (admin)</span><span style="color:red"> *</span>',
"copyright" => '<span data-html="true" data-toggle="tooltip" title="Ajouter l\'année du copyright dans le footer de vos
message.<br><b>Exemple :: 2018, ne peut &ecirc;tre autre indication sauf l\'année en 4 chiffre.</b>"> Année copyright
</span>
<span style="color:red"> *</span>'
);
echo form_open('admin/config/'.$this->idM, 'class="form-horizontal"');
foreach ($res->result_array() as $data) {
echo '<div class="form-group">
<label class="control-label col-sm-3" for=' . $data['config_name'].'>'.$config_name[$data['config_name']].'</label>
<div class="col-sm-6">
<input class="form-control input-sm" type="text" id="'.$data['config_name'].'" value="'.$data['config_value'].'" name="'.$data['config_name'] . '" >
</div></div>';
}
echo '<div class="form-group">
<label class="control-label col-sm-3" for="submit" id="submit"></label>
<div class="col-sm-9">
<input class="btn btn-success btn-sm" id="submit" name="submit" type="submit" value="Envoyer" />
<input  type="hidden" name="config" value="true">
</div></div>';
echo form_close();
break;
//-------------------------------- logo forum -----------------------------------
case 'add logo':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('home') ?>">Home</a></li>
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Logo </li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Ajouter un logo au Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, Vous pouvez ajouter un logo à votre forum.<br>
                                Veuillez selectionnez une image sur votre machine et suivez les instruction pour ajouter votre
                                logo.<br>
                                Le logo sera redimensionné automatiquement.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<br><br>
Logo Par défaut du forum :
<img data-toggle="tooltip" title="Vous pouvez changer l\'image par défaut du forum en choisissant une image de
votre choix sur votre machine. "  class="img-thumbnail img-responsive" src="'.base_url('assets/uploads/'.$logo) . '"
alt="image forum" />';
echo '<p>En attente d\'image</p>';
echo '<div id="wrapper">';
echo '<img id="output_logo"/>
</div>';
echo 'Selectionnez';
echo form_open_multipart('admin/add_logo/'.$this->idM . '/1');
echo '<div class="col-sm-5">';
echo '<input class="form-control" type="file" name="logo" accept="image/*" onchange="preview_logo(event)">';
echo '</div>';
echo '<input type="hidden" name="add_logo" value="1">';
echo '<input class="btn btn-success btn-sm" type="submit" name="submit" value="Envoyer" /> ';
echo form_close();
echo br(2);
if(isset($add_logo) && $add_logo=='add_logo'){
?>
<script>
function preview_logo(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_logo');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php
}
break;
//-------------------------------- ajouter image -----------------------------------
case 'add img':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Image forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Modifier L'image du Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, Vous pouvez changer l'image par défaut du forum en choisissant
                                une image personnalisée de votre
                                choix. <br>Cependant, votre image ne doit pas dépasser 200px de hauteur sur 300px de
                                largeur autrement le bloc contenant l'image sera déformé.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
$img = '<img class="img-responsive" width="60%"  src="' . base_url('assets/img/capture_topage.jpg') . '" alt="forum fabb"
title="Agrandir cette image"/>';
echo anchor_popup('admin/anchor/' . $this->idM, $img);
echo '<br><br>
Image Par défaut du forum :
<img data-toggle="tooltip" title="Vous pouvez changer l\'image par défaut du forum en choisissant une image de
votre choix sur votre machine. "  class="img-thumbnail img-responsive" src="' . base_url('assets/uploads/' . $pic) . '"
alt="image forum" />';
echo '<p>En attente d\'image</p>';
echo '<div id="wrapper">';
echo '<img id="output_image"/>
</div>';
echo 'Selectionnez';
echo form_open_multipart('admin/add_img/' . $this->idM . '/1');
echo '<div class="col-sm-5">';
echo '<input class="form-control" type="file" name="userfile" accept="image/*" onchange="preview_image(event)">';
echo '</div>';
echo '<input type="hidden" name="add_img" value="1">';
echo '<input class="btn btn-success btn-sm" type="submit" name="submit" value="Envoyer" /> ';
echo form_close();
echo br(2);
break;
//---------------------------- all cat --------------------------------------------------
case 'all_cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">catégories</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>La liste Des Catégories </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, Vous trouverez toutes les catégories disponibles dans le forum.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
$i = 1;
if ($list_cat->num_rows() > 0) {
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>Id</th>
<th>Categorie</th>
<th>Ordre</th>
</tr>';
foreach ($list_cat->result() as $cat) :
echo '<tr>';
echo '<td>' . $i . '</td>';
echo '<td>' . htmlspecialchars($cat->cat_name) . '</td>';
echo '<td>' . htmlspecialchars($cat->cat_order) . '</td>';
echo '</tr>';
$i++;
endforeach;
echo '</table>';
} else {
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>ordre</th>
<th>categorie</th>
</tr>
<tr>
<td colspan="2"> <p style="color:red !important;">Le forum ne contient aucune categorie pour l\'instant.<br>
Veuillez ajouter des categories à votre forum svp ....!  </p></td>
</tr>
</table>';
}
break;
//---------------------------- add cat ------------------------------------------------
case 'add cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">add cat</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Ajouter une Catégorie </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, Vous pouvez ajouter des catégories à votre forum.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table class="table table-bordered table-responsive containerbox">
<tr>
<td>';
echo form_open('admin/add_cat/' . $this->idM . '/new_cat');
echo '<div class="form-group">' .
form_error('nom') . '
<label for="nom"> Nom catégorie :</label><br>
<div class="col-sm-6">
<input class="form-control" type="text" value="' . set_value('nom') . '" id="nom" name="nom" /><br>
<input class="btn btn-success btn-sm" type="submit" value="Envoyer"> |
<a href="' . base_url('admin/index/' . $this->idM) . '" class="btn btn-success btn-sm"> Annuler</a>';
echo '  </div>
</div>';
echo form_close();
echo '
</div>
</td></tr></table>';
break;
//------------------------------------------------select cat -------------------
case 'select cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">select cat</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Sellection de Catégorie </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Pour éditer une catégorie, Vous devez d'abord la sellectionner.<br>
                                Utilisez le formulaire ci-dessous pour choisir une catégorie à éditer.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<td>';
echo form_open('admin/edit_cat/' . $this->idM);
echo '<div class="col-sm-6">
<div class="form-group">
<label class="control-label" for="selection">Editer une catégorie:</label>
<select class="form-control" name="cat" id="selection">';
foreach ($query->result_array() as $data) :
echo '<option value="' . $data['cat_id'] . '">' . $data['cat_name'] . '</option>';
endforeach;
echo '</select>' . br(1) . '
<input type="submit" class="btn btn-primary" value="Envoyer">
</div></div>';
echo form_close();
echo '</div></td></tr></table>';
break;
//--------------------------------------------------------------------------------------------------------------------
case 'edit cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Editer cat</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>&Eacute;diter une Catégorie </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Veuillez choisir le nouveau nom pour cette catégorie..
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
foreach ($query->result() as $data) :
echo form_open('admin/edited_cat/' . $this->idM);
echo '<div class="form-group">
<div class="col-md-6">
<label for="nom">Nouveau nom de la catégorie</label>';
echo '<input class="form-control" type="text" id="nom" name="nom" value="' . htmlspecialchars($data->cat_name) . '" />
<br>
<input type="hidden" name="cat" value="' . $_POST['cat'] . '" />
<input type="submit" class="btn btn-primary" value="Envoyer" />
</div></div>';
echo form_close();
endforeach;
break;
//---------------------------- del cat ------------------------------------------------
case 'del cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">select cat</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Sellection de Catégorie </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Pour supprimer une catégorie, Vous devez d'abord la sellectionner.<br>
                                Utilisez le formulaire ci-dessous pour choisir une catégorie à supprimer.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<td>';
echo form_open('admin/categorie/' . $this->idM . '/supprimer');
echo '<div class="col-sm-6">
<div class="form-group">';
echo ' <label class="control-label">Choisir Une Catégorie </label>
<select class="form-control"  name="cat">';
foreach ($query->result() as $data) {
echo '<option class="form-control" value="' . htmlspecialchars($data->cat_id) . '">'
. htmlspecialchars($data->cat_name) . '</option>';
}
echo '</select>' . br(2) . '
<input class="btn btn-success" type="submit" value="Envoyer">';
echo form_close();
echo '</div>
</td></tr></table>';
break;
case 'select ord cat':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Ordre cat</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Ordre Catégories </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, vous pouver changer l'ordre des catégories.<br>
                                Toute fois, éviter de donner le m&ecirc;me ordre pour 2 catégories différentes,
                                celà peut engendrer des erreurs dans la base de donnée.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('admin/edit_ord_cat/' . $this->idM, 'class="form-horizontal"');
if ($query->num_rows() > 0) {
foreach ($query->result_array() as $val) :
echo '<div class="form-group">
<label class="control-label col-sm-3" for="' . htmlspecialchars($val['cat_name']) . '">
' . htmlspecialchars($val['cat_name']) . '</label>';
echo '<div class="col-sm-3">
<input class="form-control input-sm" id="' . $val['cat_name'] . '"
type="text" value="' . htmlspecialchars($val['cat_order']) . '" name="' . htmlspecialchars($val['cat_id']) . '" >
</div></div>';
endforeach;
echo '
<div class="form-group">
<label class="control-label col-sm-3" for="submit" id="submit"></label>
<div class="col-sm-9">
<input class="btn btn-success btn-sm" id="submit" name="submit" type="submit" value="Envoyer" />
</div></div>';
echo form_close();
} else {
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>Changer l\'ordre des catégories</th>
</tr>';
echo '<tr>';
echo '<td> <p style="color:red !important;">Le forum ne contient aucune categorie pour l\'instant.<br>
Veuillez ajouter des categories à votre forum svp ....!  </p></td>
</tr></table>';
}
break;
//---------------------------- all forum --------------------------------------------------
case 'all_forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Liste forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Liste des Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver consulter la liste de tous les forums présent dans la base
                                de donnée.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
if ($list_forum->num_rows() > 0) {
echo '<P>Consulter la liste des forums</p>';
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>ordre</th>
<th>Forum</th>
<th>Nbr topic</th>
</tr>';
$i = 1;
foreach ($list_forum->result() as $val) :
echo '<tr>';
echo '<td>' . $i . '</td>';
echo '<td>' . htmlspecialchars($val->forum_name) . '</td>';
echo '<td>' . htmlspecialchars($val->forum_topic) . '</td>';
echo '</tr>';
$i++;
endforeach;
echo '</table>';
} else {
echo '<P>Consulter la liste des forums</p>';
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>ordre</th>
<th>categorie</th>
<th>Nbre Forum</th>
</tr>';
echo '<tr>';
echo '<td colspan="3">Le forum pour l\'instant est vide.<br>
Veuillez ajouter des forums dans les categorie svp ....!  </td>';
echo '</tr>';
echo '</table>';
}
break;
case 'creer forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Add forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Ajouter un Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver ajouter des forums.<br>
                                Les champs proposés dans le formulaire sont obligatoires.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?= form_open('admin/add_forum/' . $this->idM . '/create', 'class="form-horizontal"'); ?>
            <?= form_error('nom') ?>
            <div class="form-group">
                <label class="control-label col-sm-3" for="nom">Nom du forum :<i style=" font-size:10px;color:red;">
                        (*)</i>
                </label>
                <div class="col-sm-6">
                    <input class="form-control input-sm" type="text" id="nom" name="nom"
                        value="<?= set_value('nom') ?>" /><br />
                </div>
            </div>
            <?= form_error('desc') ?>
            <div class="form-group">
                <label class="control-label col-sm-3" for="desc">Desception : <i style=" font-size:10px;color:red;">
                        max 128 caractères (*)</i></label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="4" name="desc" id="desc"><?= set_value('desc') ?></textarea>
                </div>
            </div>
            <?= form_error('page') ?>
            <div class="form-group">
                <label class="control-label col-sm-3">Forum Groupe</label>
                <div class="col-sm-6">
              <select class="form-control input-sm" name="page" id="page">
              <option <?php if (set_value('page') == "choisir") echo 'selected'; ?> value="choisir">choisir</option>
              <option <?php if (set_value('page') == "Annonce") echo 'selected'; ?> value="Annonce">Annonce</option>
              <option <?php if (set_value('page') == "Discussion") echo 'selected'; ?> value="discussion"> Discussion</option>
                    </select>
                </div>
            </div>
            <?= form_error('cat') ?>
            <div class="form-group">
                <label for="cat" class="control-label col-sm-3">Categorie</label>
                <div class="col-sm-6">
                    <select class="form-control" name="cat">
                        <option <?php if (set_value('cat') == "choisir") echo 'selected'; ?> value="choisir">choisir
                        </option>
                        <?php
foreach ($res->result() as $val) {
echo '<option value="' . $val->cat_id . '">' . $val->cat_name . '</option>';
}
?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3"></label>
                <div class="col-sm-6">
                    <input class="btn btn-primary btn-sm" name="submit" type="submit" value="Envoyer"> |
                    <a href="'.base_url('admin/index'.$this->idM).'" class="btn btn-success btn-sm"> Annuler</a>
                </div>
            </div>
            <?= form_close() ?>
            <?php
break;
case 'select forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">&Eacute;dit forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>&Eacute;diter un Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver editer les forums.<br>Les champs proposés dans le
                                formulaire sont obligatoires.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th> Edition d\'un forum </th>
</tr>
<tr>
<td>';
echo form_open('admin/edit_forum/' . $this->idM, 'class="form-horizontal"');
echo ' <div class="form-group">
<label class="control-label col-sm-3" >Catégorie</label>
<div class="col-sm-6">
<select class="form-control" name="forum">';
foreach ($query->result() as $data) :
echo '<option value="' . htmlspecialchars($data->forum_id) . '">' . htmlspecialchars($data->forum_name) . '</option>';
endforeach;
echo '</select>
</div></div>
<div class="form-group">
<label class="control-label col-sm-3"></label>
<div class="col-sm-6">
<input class="btn btn-primary btn-sm" name="submit" type="submit" value="Envoyer">
</div></div>';
echo form_close();
echo '</td></tr></table>';
break;
case 'edit forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">&Eacute;dit forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>&Eacute;diter un Forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver editer le forum selectionné.<br></p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('admin/edited_forum/' . $this->idM, 'class="form-horizontal"');
foreach ($query->result() as $val) :
echo '<table style="color:#6C6C6C; font-size:1.2rem;" class="table table-striped table-bordered
table-responsive">';
echo '<tr>
<th> Edition du forum :: <strong>' . htmlspecialchars($val->forum_name) . '</strong> </th>
</tr>
<tr>
<td>';
echo '<div class="form-group">';
echo '<label for="nom" class="control-label col-sm-3">Nom du forum : </label>
<div class="col-sm-6">
<input class="form-control" type="text" id="nom" name="nom" value="' . htmlspecialchars($val->forum_name) . '" />
</div></div>
<div class="form-group">';
echo '<label for="desc" class="control-label col-sm-3">Description  </label>
<div class="col-sm-6">
<textarea class="form-control" rows="4" name="desc" id="desc">' . htmlspecialchars($val->forum_desc) . '</textarea>
<input type="hidden" name="forum_id" value="' . htmlspecialchars($val->forum_id) . '">
</div></div>
</td></tr>';
endforeach;
echo '</table>
<tr>
<td>
<div class="form-group">
<label class="control-label col-sm-3">Déplacer vers  </label>
<div class="col-sm-6">
<select class="form-control" name="depl">';
foreach ($query2->result() as $val) :
echo '<table style="color:#6C6C6C; font-size:1.2rem;" class="table table-striped table-bordered
table-responsive">';
if ($val->cat_id == htmlspecialchars($val->forum_cat_id)) {
echo '<option value="' . htmlspecialchars($val->cat_id) . '" selected>' . htmlspecialchars($val->cat_name) . ' </option>';
} else {
echo '<option value="' . htmlspecialchars($val->cat_id) . '">' . htmlspecialchars($val->cat_name) . '</option>';
}
endforeach;
echo '</select>
</div></div>
</td></tr>
<tr><td>
<div class="form-group">
<label class="control-label col-sm-3"></label>
<div class="col-sm-6">
<input  class="btn btn-primary btn-sm" type="submit" value="Envoyer"></p>
</div></div>
</td></tr>';
echo form_close();
break;
case 'move forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Déplacer</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style=" font-size:1.2rem" class="table table-responsive table-striped">
                    <tr>
                        <th>Déplacer un forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver déplacer un forum vers une autre catégorie.<br>
                                Il faut selectionner dans la liste déroulante le forum à déplacer, et la catégorie vers
                                laquelle le forum sera déplacé </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('admin/move_forum/' . $this->idM, 'class="form-horizontal"');
echo '<div class="form-group">
<label for="forum" class="label-control col-sm-2">Selectionner: </label>
<div class="col-sm-5">
<select name="forumName" class="form-control input-sm">';
foreach ($query->result() as $data) {
echo '<option value=' . $data->forum_id . ' id=' . $data->forum_id . '>' . $data->forum_name . '</option>';
}
echo '
</select>
</div></div>';
echo '<div class="form-group">
<label for="cat" class="label-control col-sm-2">Déplacer vers: </label>
<div class="col-sm-5">
<select name="cat" class="form-control input-sm" id="cat">';
foreach ($queryCat->result() as $data) {
echo '<option value=' . $data->cat_id . ' id=' . $data->cat_id . '>' . $data->cat_name . '</option>';
}
echo '
</select>
</div></div>
<div class="form-group">
<label class="label-control col-sm-2"></label>
<div class="col-sm-5">
<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Envoyer" /> |
<a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Annuler</a>
</div></div>';
echo form_close();
break;
case 'select ord forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Ordre forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Ordre des forums </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, vous pouver changer l'ordre des forums.<br>
                                Toute fois, éviter de donner le m&ecirc;me ordre pour 2 forums différents,
                                celà peut engendrer des erreurs dans la base de donnée.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table style=" font-size:1.2rem;color:#6C6C6C;" class="table table-striped table-bordered
table-responsive">
<tr>
<th colspan="2"> Changer l\'ordre des forums </th>
</tr>
<tr>
<td>Catégorie/Forum</td>
<td>Ordre</td>
</tr>';
echo form_open('admin/edit_ord_forum/' . $this->idM);
foreach ($query->result() as $data) :
if ($categorie !== $data->cat_id) {
$categorie = $data->cat_id;
echo '<tr>
<td colspan="2">' . htmlspecialchars($data->cat_name) . '</strong></td>
</tr>';
}
echo '<tr>
<td>
<a href="' . base_url('voir/forum/' . htmlspecialchars($data->forum_id)) . '">' . htmlspecialchars($data->forum_name) . '
</a></td>
<div class="col-sm-3">
<div class="form-group">
<td><input class="form-control input-sm" type="text" value="' . $data->forum_order . '" name="' . htmlspecialchars(
$data->forum_id
) . '"
/>
</div></div></td>
</tr>';
endforeach;
echo '
</div>
</table>
<input class="btn btn-success btn-sm" type="submit" value="Envoyer">';
echo form_close();
echo br(2);
break;
case 'select droit forum':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Droit forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Droit sur un forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver spécifier le droit sur un forum. Qui veut dire, qui doit
                                faire quoi <br>
                                sur un forum. vous trouverez d'autres explications dans la prochaine page.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('admin/edit_droit/' . $this->idM);
echo '<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
<div class="form-group">
<tr>
<th> Editer les droit d\'un forum</th>
</tr>
<tr>
<td>';
echo '<p>Choisir un forum :</p>
<div class="col-sm-6">
<select name="forum" class="form-control input-sm">';
foreach ($query->result() as $val) :
echo '<option value="' . htmlspecialchars($val->forum_id) . '">' . htmlspecialchars($val->forum_name) . '</option>';
endforeach;
echo '</select>
</div>
</td></tr>
<tr>
<td>
<input class="btn btn-success" type="submit" value="Envoyer">
</td>
</tr>
</div>
</table>';
echo form_close();
break;
case 'edit droit':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Droit forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem" class="table table-responsive table-striped">
                    <tr>
                        <?php foreach ($query->result_array() as $resp) : ?>
                        <th>Droit sur le forum: <span
                                style="color:red"><strong><?= htmlspecialchars($resp['forum_name']) ?></strong></span>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Un visiteur a le droit de consulter les forums, topic et post. Un membre en plus des
                                droits du visiteur peut poster
                                des sujets, des réponses et acceder à son Control-Panel. Un modérateur en plus des
                                droits du membre peut intervenir
                                presque sur l'ensemble des options du forum. L'administrateur est le Big-Boss, il fait
                                ce qu'il veut sur son forum,
                                a l'accès à toutes les options du forum.<br>
                                Une des options dans l'application de ce forum est que vous pouver spécifier le droit
                                que vous voulez attribuer à
                                un forum donné.<br>
                                Vous aviez choisi le forum: <span
                                    style="color:red"><strong><?= $resp['forum_name'] ?></strong></span>, qui peut le
                                consulter, poster ou meme le modérer.<br>
                                Les comptes dont le niveau suivant : membre banni, membre suprimé et membre en attente
                                s'il ne se connectent pas à
                                leurs comptes son considérés comme des visiteurs. s'ils se connectent, le script les
                                traitera chaqu'un en fonction
                                de son statut.<br>
                                <span style="color:red"><strong>NB:</strong></span> N'attribuer jamais la modération
                                des forums en dehors des
                                modérateurs.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('admin/edited_droit/' . $this->idM);
echo '<table class="table table-striped table-bordered table-responsive containerbox">
<div class="form-group">
<tr>
<th>Lire</th>
<th>Répondre</th>
<th>Poster</th>
<th>Annonce</th>
<th>Modérer</th>
</tr>';
$rang = array(
VISITOR => "Visiteur",
MEMBER => "Membre",
MODO => "Modérateur"
);
$list = array("forum_auth_view", "forum_auth_post", "forum_auth_topic", "forum_auth_annonce", "forum_auth_modo");
foreach ($list as $field) {
echo '<td>
<p>Forum: ' . htmlspecialchars($resp['forum_name']) . '</p>
<select class="form-control" name="' . $field . '">';
foreach ($rang as $key => $stat) {
if ($key == $resp[$field]) {
	echo '<option value="' . $key . '" selected>' . $rang[$key] . '</option>';
} else {
	echo '<option value="' . $key . '">' . $rang[$key] . '</option>';
}
}
echo '</td></select>';
}
endforeach;
echo '</div>
</table>
<input type="hidden" name="forum_id" value="' . htmlspecialchars($resp['forum_id']) . '" />
<input class="btn btn-primary btn-sm" type="submit" value="Envoyer">';
echo form_close();
echo br(2);
break;
case "delete forum":
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Supprimer forum</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Supprimer un forum </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver supprimer un forum. Veuillez choisir dans la selection le
                                forum à supprimer.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
<tr>
<th> Supression de forum </th>
</tr>
<tr>
<td>
<div class="form-group">';
echo form_open('admin/delete_forum/' . $this->idM);
echo '<h1 style="color:#909090;font-size:1.1em;">Choisir un forum :</h1>
<select class="form-control" name="forum">';
foreach ($query->result() as $val) :
echo '<option value="' . $val->forum_id . '">
' . htmlspecialchars($val->forum_name) . '</option>';
endforeach;
echo '</select><br /><br />
<input class="btn btn-success" type="submit" value="Envoyer">';
echo form_close();
echo '</div>
</td></tr></table>';
break;
case 'consulter topic':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">All topic</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Consulter les topic </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver consulter tous les topic du forum.<br>
                                En plus de la consultation, vous pouvez éditer, supprimer, verrouiller, dévérrouiller
                                et ajouter <br>
                                des nouveaux topic à la liste éxistante en cliquant sur l'icone correspondante.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo $link;
echo '<table class="table table-striped table-responsive containerbox">
<tr>
<th> liste des topic </th>
</tr>
<tr>
</table>';
if ($query->num_rows() > 0) {
echo
'<table style="color:#6C6C6C; font-size:1.2rem;text-align:center;" class="table table-striped table-bordered table-responsive">
<tr>
<th>Ordre</th>
<th>Forum</th>
<th>Titre Topic</th>
<th>Total Post</th>
<th>Créateur</th>
<th>Date</th>
<th>Action</th>
</tr>
<div class="form-group">';
foreach ($query->result() as $val) :
echo '<tr>
<td>' . $val->topic_id . '</td>
<td>' . $val->forum_name . '</td>
<td><a data-toggle="tooltip" title="Allez voir ce topic" href="' . base_url('voir/topic/' . $val->topic_id) . '">' . $this->bbcode->netcode($val->topic_title) . '</a></td>
<td>' . $this->bbcode->netcode($val->topic_post) . '</td>
<td><img class="img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $val->member_avatar), 30, 30) . '" alt="pas d avatar" />
<a data-toggle="tooltip" title="voir le profil de ' . $val->member_pseudo . '...!" href="' . base_url('member/visit_profil/' . $this->idM . '/' . $val->member_id) . '">' . $val->member_pseudo . '  </a></td>
<td><span style="font-size:10px">' . date('\L\e d M Y \à H\hi', $val->topic_time) . '</span><br /></td>
<td> <a data-toggle="tooltip" title="Editez ce topic " href="' . base_url('admin/edit_topic/' . $this->idM . '/' . $val->topic_id) . '">' . $this->config->item('edit') . '</a> |
<a data-toggle="tooltip" title="Supprimez ce topic "  href="' . base_url('admin/delete_topic/' . $this->idM . '/' . $val->topic_id) . '">' . $this->config->item('delete') . '</a> | ';
if ($val->topic_locked == 1) {
echo '<a  data-toggle="tooltip" title="déverouiller ce topic " href="' . base_url('unlock/topic/' . $val->topic_id) . '">' . $this->config->item('lock') . '</a>';
} else {
echo ' <a data-toggle="tooltip" title="verouiller ce topic " href="' . base_url('lock/topic/' . $val->topic_id) . '">' . $this->config->item('lock_open') . '</a> ';
}
echo ' | <a data-toggle="tooltip" title="Ajouter un topic au forum: ' . $val->forum_name . '" href="' . base_url('poster/add_topic/' . $val->topic_forum_id) . '">' . $this->config->item('plus_topic') . '</a>';
echo '</td>
</tr>';
endforeach;
echo '</div>
</table>';
echo $link;
} else {
echo
'<table style=" color:#6C6C6C; font-size:1.2rem;text-align:center;" class="table table-striped table-bordered table-responsive containerbox">
<tr>
<th>Ordre</th>
<th>Forum</th>
<th>Titre Topic</th>
<th>Total Post</th>
<th>Créateur</th>
<th>Date</th>
<th>Action</th>
</tr>
<tr>
<td colspan="7">
Il n\'y a aucun topic dans le forum
</td>
</tr>
</table>';
}
break;
case 'edit topic':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">&Eacute;dition topic</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>&Eacute;dition de topic: <span style="color:red"><strong><?= $titre_topic ?></strong></span>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                &Aacute; partir de cette page, vous pouvez éditer le topic choisi:
                                <strong><?= $titre_topic ?></strong> . <br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo '
<p><strong> Information sur le topic </strong></p>';
echo '<table class="table table-striped table-responsive containerbox">
<tr>
<td> cat </td>
<td> forum </td>
<td> texte</td>
<td> Rédigé le</td>
</tr>
<tr>
<td> ' . $cat_name . '</td>
<td> ' . $forum_name . '</td>
<td> ' . $this->bbcode->netcode(substr($post_text, 0, 40)) . ' ...</td>
<td> <span style="font-size:11px;">' . time_elapsed($post_time) . '</span></td>
</tr>
<tr></table>';
echo '<p><strong> Information sur le createur du topic </strong></p>';
echo '<table class="table table-striped table-responsive containerbox">
<tr>
<td> Pseudo </td>
<td> email </td>
<td> avatar</td>
<td> Inscrit</td>
<td> derniere visite</td>
</tr>
';
echo '<tr>
<td> ' . $m_pseudo . '</td>
<td> ' . $m_email . '</td>
<td> <img class="img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $m_avatar), 30, 30) . '" alt="pas d avatar" />
</td>
<td><span style="font-size:11px;"> ' . time_elapsed($m_inscrit) . '<span></td>
<td><span style="font-size:11px;">' . time_elapsed($m_last_visit) . '</span></td>
</tr>
<tr>
</table>
<hr>';
$action = base_url('admin/edited_topic/' . $this->idM . '/' . $topic);
$attributs = array(
'id' => 'myform',
'name' => 'myform'
);
$this->load->add_package_path(APPPATH . 'third_party/resources', FALSE);
if ($this->config_model->bbcode() == 'oui') {
$this->load->view('textbbcode');
}
if ($this->config_model->smiley() == 'oui') {
$this->load->view('textsmiley');
}
$this->load->remove_package_path(APPPATH . 'third_party/resources');
echo '<hr style=" margin-left:0 !important;width:60%;">';
echo form_open($action, $attributs);
echo form_error('message'); ?>
            <div class="form-group">
                <label for="message">Message <span style=" color:red">*</span></label>
                <textarea class="form-control" style="width:60%; height:30vh;" id="message" name="message"><?php if ($this->input->post('message')) echo htmlspecialchars($this->input->post('message'));
																else echo htmlspecialchars($post_text); ?> </textarea>
            </div>
            <input type="hidden" name="post_id" value="<?= $post_id ?>" />
            <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Envoyer" />
            <input class="btn btn-primary btn-sm" type="reset" name="Effacer" value="Effacer" />
            <input type="submit" class="btn btn-default btn-sm" id="preview" name="preview" value="Preview" />
            <?php
echo form_close();
?>
            <fieldset>
                <div id="loading"><img src="<?= base_url('assets/img/loader.gif') ?>"></div>
                <div id="preview_rep"></div>
            </fieldset>
            <br><br>
            <script>
            $(document).ready(function() {
                $("#smilies").css('display', 'none');
                $("#smiley img").click(function() {
                    $("#smilies").toggle(1000);
                });
                $("#loading").css("display", "none");
                $("#preview").click(function(e) {
                    e.preventDefault();
                    var formInput = $('#myform').serialize();
                    $.ajax({
                        url: '<?= base_url("ajaxcall/new_pm") ?>',
                        type: "post",
                        data: formInput,
                        beforeSend: function() {
                            $("#loading").fadeIn(2000);
                        }
                    }).done(function(result) {
                        $("#preview_rep").html(result);
                    }).fail(function(xhr, status, error) {
                        $("#preview_rep").html("Result: " + status + "<br> " + error + " :" +
                            xhr.status + "<br> " + xhr.statusText);
                    });
                    $(document).ajaxComplete(function() {
                        $("#loading").fadeOut(2000);
                    });
                });
            });
            </script>
            <?php
break;
case 'list members':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Membres</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem" class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Liste des membres </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouvez consulter la liste des membres du forum.<br>
                                Vous pouvez faire la recherche d'un membre plus rapidement en utilisant le champ
                                recherche rapide.<br>
                                <strong style="background-color:rgb(85,85,85); padding:2px;">Astuce de
                                    Recherche:</strong> Dans le champ Nbr de lignes, choisissez le nombre le plus
                                proche à celui de votre liste.<br>
                                Ensuite dans le champ "recherche rapide", en introduisant les premières lettre du
                                pseudo du membre à rechercher, les résultats s'auto-eliminent pour n'afficher que le
                                membre dont le pseudo concorde à votre recherche.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo $link;
echo form_open('admin/members_list/' . $this->idM, 'class="form-inline"');
echo '
<div class="form-group">';
echo '<label for="sort">Trier par : </label>
<select class="form-control input-sm" name="sort" id="sort">
<option value="0">Membre id </option>
<option value="1" >Pseudo</option>
<option value="2" >Nbre Messages</option>
<option value="3">Dernière visite</option>
</select>
</div>
<div class="form-group">
<label for="tri"> Mode : </label>
<select class="form-control input-sm" name="tri" id="tri">
<option value="0" >Croissant</option>
<option value="1" >Décroissant</option>
</select>
</div>
<div class="form-group">
<label for="limit"> Nbr de lignes </label>
<select class="form-control input-sm" name="limit" id="limit">
<option value="' . $this->config_model->member_par_page() . '">Défault</option>
<option value="50">50 lignes</option>
<option value="100">100 lignes</option>
<option value="200">200 lignes</option>
<option value="400">400 lignes</option>
<option value="800">800 lignes</option>
<option value="1500">1500 lignes</option>
</select>
</div>
<div class="form-group">
<input class="form-control input-sm" name="envoyer" type="submit" value="Envoyer" />
</div>';
echo form_close();
if ($resp->row() != NULL) {
?>
            <br>
            <input class="form-control" id="myInput" type="text" placeholder="Recherche rapide ...">
            <br>
            <table style="font-size:1.1rem" class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr style="color:#6F6F6F;">
                        <th class="text-center">id </th>
                        <th class="text-center">Pseudo</th>
                        <th class="text-center">Avatar</th>
                        <th class="text-center">Messages</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">Inscrit depuis</th>
                        <th class="text-center">Dernière visite</th>
                        <th class="text-center">Connecté</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
foreach ($resp->result() as $value) {
echo '<tr style="color:#6F6F6F;">
<td>' . htmlspecialchars($value->member_id) . '</td>
<td>
<a style="color:blue" href="' . base_url('member/profil/' . $this->idM . '/' . $value->member_id) . '">' . htmlspecialchars($value->member_pseudo) . '</a></td>
<td><img class="img-fluid img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $value->member_avatar), 25, 25) . '"></td>
<td>' . $value->member_post . '</td>
<td>';
if ($value->member_level == 0) {
$statut = 'Membre banni';
} elseif ($value->member_level == 2) {
$statut = 'Membre suprimé(e)';
} elseif ($value->member_level == 3) {
$statut = 'Membre en instance';
} elseif ($value->member_level == 4) {
$statut = 'Membre actif(ve)';
} elseif ($value->member_level == 5) {
$statut = 'Modérateur';
} elseif ($value->member_level == 6) {
$statut = 'Administrataur';
}
echo $statut;
echo '</td>
<td>' . time_elapsed($value->member_registred) . '</td>
<td>' . time_elapsed($value->member_last_visit) . '</td>';
if (empty($value->online_id)) {
echo '<td>' . $this->config->item('wifi_off') . '</td>';
} else {
echo '<td>' . $this->config->item('wifi_on') . '</td>
</tr>';
}
}
?>
                </tbody>
            </table>
            <?php
} else {
echo '<p>Ce forum ne contient aucun membre actuellement</p>';
}
echo $link;
?>
            <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            </script>
            <?php
break;
case 'select member':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Membres </li>
            </ul>
            <hr>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem; color:rgb(255,255,255);" class="table table-responsive table-striped">
                    <tr>
                        <th style="color: #787878;">
                            <?php
if (($form_action === 'admin/update_avatar/' . $this->idM) || $this->uri->segment(4) == 'avatar') {
echo 'Editer l\'avatar d\'un membre';
} elseif ($form_action === 'admin/droit_member/' . $this->idM || $this->uri->segment(4) == 'droit') {
echo 'Editer les droits d\'un membre';
} elseif ($form_action === 'admin/bann_member/' . $this->idM || $this->uri->segment(4) == 'bann') {
echo 'Bannir un membre';
} elseif ($form_action === 'admin/simple_mail/' . $this->idM || $this->uri->segment(4) == 'mail') {
echo 'Email simple';
} elseif ($form_action === 'admin/delete_member/' . $this->idM || $this->uri->segment(4) == 'delete') {
echo 'Supprimer un compte';
} else {
echo 'Editer le profil d\'un membre';
}
?> </th>
                    </tr>
                    <tr>
                        <td>
                            <?php
if ($form_action === 'admin/update_avatar/' . $this->idM || $this->uri->segment(4) == 'avatar') {
echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez consulter et éditer l\'avatar d\'un membre. <br>Veuillez introduire le pseudo du membre.</p>';
} elseif ($form_action === 'admin/droit_member/' . $this->idM || $this->uri->segment(4) == 'droit') {
echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez éditer les droits d\'un membre. <br>Veuillez introduire le pseudo du membre.</p>';
} elseif ($form_action === 'admin/bann_member/' . $this->idM || $this->uri->segment(4) == 'bann') {
echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez bannir des membres du forum. <br>Veuillez introduire le pseudo du membre que vous voulez bannir.</p>';
} elseif ($form_action === 'admin/simple_mail/' . $this->idM || $this->uri->segment(4) == 'mail') {
echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez envoyer des messages à vos membres.<br>
Cette fen&ecirc;tre vous permet d\'envoyer seulement un seul message à la fois. <br>Veuillez introduire le pseudo du membre que vous voulez lui envoyer le message.</p>';
} elseif ($form_action === 'admin/delete_member/' . $this->idM) {
echo '<p style="color:#F0F0F0 !important;">
A partir de cette fen&ecirc;tre vous pouvez supprimer le compte d\'un membre. <br>
Important ::<br>
Supprimer le compte d\'un membre ne supprimera pas sa contribution sur le forum. toute fois, il ne pourra pas
se connecter, comme il ne pourra pas s\'enregistrer de nouveau avec la m&ecirc;me adresse email. Le membre pourra
re-activer son compte mais avec une nouvelle confirmation de son email.<br>
Si après 6 mois d\'inactivité d\'un membre, vous avez le choix d\'aviser le membre par email avant de le supprimer
définitivement de la base de donnée.<br>
Veuillez introduire le pseudo du membre que vous voulez supprimer.</p>';
} else {
echo '<p style="color:#F0F0F0 !important;">
A partir de cette page vous pouvez consulter le profil d\'un membre et de l\'éditer aussi.
<br>Il suffit d\'introduire le pseudo du membre et le tour est joué.<br>
Si vous n\'avez pas une idée sur le pseudo du membre dont vous voulez consulter son profil,<br>
allez consulter la liste des membres ensuite revinir sur cette page.</p>';
} ?>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php echo form_open($form_action);
echo form_error('membre');
?>
            <div class="form-group">
                <label class="control-label" id="membre" for="membre">Pseudo Du Membre : </label>
            </div>
            <div class="form-group col-sm-8">
                <input class="form-control input-sm member" value="<?= set_value('membre') ?>" type="text" id="membre"
                    name="membre">
                <br>
                <input class="btn btn-primary btn-sm" name="submit" type="submit" value="Valider"> |
                <input class="btn btn-primary btn-sm" type="reset" value="Effacer"> |
                <a class="btn btn-primary btn-sm" href="<?= base_url('admin/index/' . $this->idM) ?>">Annuler</a>
            </div>
            <?php echo form_close();
break;
case 'mail member':
if (isset($active)) {
$conn = $active;
} else {
$conn = 'sendMail';
}
?>
            <ul class="breadcrumb">
                                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                                            <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Envoi email</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Envoyer un message </th>
                    </tr>
                    <tr>
                        <td>
                            <p style="color:#F0F0F0 !important;">
                                Cette page vous permet d'envoyer des messages à vos membres. Seulement, il faut savoir
                                que vous ne pouvez pas envoyer plus d'un message.<br>
                                Si vous voulez envoyer des messages en masse veuillez cliquer dans le menu à gauche sur
                                :: Méssageries/Envoi multiple
                                <hr>
                                <p style="color:#F0F0F0 !important;">La connexion smtp actuellement utilisée est ::
                                    <strong><?= $conn ?></strong>
                        </td>
                    </tr>
                </table>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6">
                    <p class="input-sm">Pseudo Du Destinataire : <?= $membre_pseudo ?></p>
                </div>
            </div>
            <?= form_open('admin/mail_member/' . $this->idM, 'class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="to" class="col-sm-1 control-label">To:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control input-sm" name="to" value="<?= $membre_email ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="from" class="col-sm-1 control-label">From:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control input-sm" name="from"
                        value="<?= $this->config_model->admin_contact() ?>" readonly>
                </div>
            </div>
            <br>
            <br>
            <?= form_error('objet'); ?>
            <div class="form-group">
                <label for="objet" class="col-sm-1 control-label">Objet:</label>
                <div class="col-sm-6">
                    <input type="text" name="objet" value="<?= set_value('objet'); ?>" class="form-control input-sm"
                        id="objet" placeholder="Objet du message">
                </div>
            </div>
            <?= form_error('message'); ?>
            <div class="form-group">
                <label for="message" class="col-sm-1 control-label">Message</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="message" name="message">
</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label"></label>
                <div class="col-sm-6">
                    <input type="hidden" name="member_email" value="<?= $membre_email ?>">
                    <input type="hidden" name="member_pseudo" value="<?= $membre_pseudo ?>">
                    <input type="submit" class="btn btn-primary btn-sm" name="submit_mail" value="Envoyer">
                    <input type="reset" class="btn btn-primary btn-sm" value="Effacer">
                    <a href="<?= base_url('admin') ?>" class="btn btn-primary btn-sm">Retour Admin</a>
                </div>
            </div>
            <?php
echo form_close();
break;
case 'mail members':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Email en masse</li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Envoyer message en masse </th>
                    </tr>
                    <tr>
                        <td>
                            <p style="color:#F0F0F0 !important;">
                                Cette page vous permet d'envoyer des messages à vos membres en fonction de la liste que
                                vous avez sélectionné
                                précédement.<br>
                                <p style="color:red !important;">Important ::</p>
                                <p style="color:#F0F0F0 !important;">Si votre liste des adresse email est longue, cette
                                    opération peut prendre un certain temps.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <p class="input-sm"><strong>Liste Destinataires ::</strong></p>
                </div>
            </div>
            <?= form_open('admin/masse_mail/' . $this->idM, 'class="form-horizontal"'); ?>
            <div class="form-group">
                <label for="to" class="col-sm-3 control-label text-danger">To ::<span data-toggle="tooltip"
                        title="Vous pouvez ajouter d'autres emails, ils doivent &ecirc;tre séparés par une
virgule (,) sauf après le dernier email la virgule est facultatif."><?= nbs(2) . $this->config->item('fas_info') ?></span></label>
                <div class="col-sm-6">
                    <input type="text" readonly class="form-control input-sm" name="to" value="<?php
													foreach ($to as $contact) {
														echo $contact . ',';
													}
													?>">
                </div>
            </div>
            <div class="form-group">
                <label for="from" class="col-sm-3 control-label text-danger"><span data-toggle="tooltip"
                        title="Obligatoire.">From :: </span></label>
                <div class="col-sm-6">
                    <input type="email" class="form-control input-sm" name="from"
                        value="<?= $this->config_model->admin_contact() ?>" readonly>
                </div>
            </div>
            <br>
            <br>
            <?= form_error('objet'); ?>
            <div class="form-group">
                <label for="objet" class="col-sm-3 control-label text-danger"><span data-toggle="tooltip"
                        title="Obligatoire.">Objet ::</span> </label>
                <div class="col-sm-6">
                    <input type="text" name="objet" value="<?= set_value('objet'); ?>" class="form-control input-sm"
                        id="objet" placeholder="Objet du message est obligatoire">
                </div>
            </div>
            <?= form_error('message'); ?>
            <div class="form-group">
                <label for="message" class="col-sm-3 control-label text-danger"><span data-toggle="tooltip"
                        title="Obligatoire.">Message ::</span></label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="message" name="message">
</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <input type="hidden" name="member_email" value="">
                    <input type="hidden" name="member_pseudo" value="">
                    <input type="submit" class="btn btn-primary btn-sm" name="masse_mails" value="Envoyer">
                    <input type="reset" class="btn btn-primary btn-sm" value="Effacer">
                </div>
            </div>
            <?php
echo form_close();
break;
case 'profil member':
?>
            <ul class="breadcrumb">
                <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Profil Membre</li>
            </ul>
            <?php
echo form_open_multipart('admin/update_member/' . $this->idM, 'class="form-horizontal"');
foreach ($query->result() as $value) :
?>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="color:#F0F0F0 !important;font-size:1.2rem" class="table table-responsive table-striped">
                    <tr>
                        <th style="color:#7D7D7D;">
                            Consulter/Editer le profil de: <?= htmlspecialchars($value->member_pseudo) ?>.
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <p style="color:#F0F0F0 !important; font-size:1.3rem !important;">
                                La présente page vous permet de consulter / éditer le profil de
                                <?= htmlspecialchars($value->member_pseudo) ?>. <br>certaine données sont propres au
                                membre, par conséquence vous ne pouvez pas les changer. D'autres ne les sont pas.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <fieldset>
                <?php
if (isset($form_errors)) {
$i = 1;
echo '<table style="font-size:1rem" class="table table-striped table-responsive">
<tr>
<th> Erreur </td>
<th> Nature </td>
</tr>';
foreach ($form_errors as $row) {
echo '<tr>
<td>' . $i . ' </td>
<td><span style="font-size:1rem;color:red">' . $row . '</span> </td>
</tr> ';
$i++;
}
echo '</table>';
}
echo '<hr>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="id"></label>
<div class="col-sm-9">
<div class="form-control text-center" >Informations De Compte</div>
</div>
</div>';
echo '<hr>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="id">Identifiant : <span data-toggle="tooltip" title="Vous ne pouvez pas changer l\'id du membre, c\'est une donnée sensible dans la BD">' . $this->config->item('fas_circle') . '</span> </label>
<div class="col-sm-9">
<input class="form-control" type="text" name="membre_id" id="id" readonly value="' . htmlspecialchars($value->member_id) . '">
</div>
</div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="pseudo">Pseudo : </label>
<div class="col-sm-9">
<input class="form-control" type="text" name="pseudo" id="pseudo" value="' . htmlspecialchars($value->member_pseudo) . '"></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="email">E_Mail :</label>
<div class="col-sm-9">
<input class="form-control" type = "text" name="email" id="email" value="' . htmlspecialchars($value->member_email) . '" />
</div></div>
<div class="form-group">
<label class="control-label col-sm-3" for="rang"> Rang : <span data-toggle="tooltip" title="Vous pouvez changer le niveau du membre en suivant le lien juste à gauche : membres/droit du membre" style="font-size:14px;"><i class="fas fa-info-circle"></i></span> </label>
<div class="col-sm-9">
<input class="form-control" type="text" name="rang" readonly id="rang"
value="' . htmlspecialchars($value->member_level) . '">
</div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="inscrit">Inscrit :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="inscrit" id="inscrit" value="' . htmlspecialchars(time_elapsed(($value->member_registred))) . '" ></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="nbr_post">Nbr de poste : <span data-toggle="tooltip" title="Nombre de post que le membre a posté dans les différents sujets du forum">' . $this->config->item('fas_circle') . '</span> </label>
</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="nbr_post" id="nrb_post"
value="' . htmlspecialchars($value->member_post) . '" /></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="news_ltr">News letter :</label>
<div class="col-sm-9">
<input class="form-control" type="text" name="news_ltr" id="news_ltr"
value="' . htmlspecialchars($value->member_notify) . '"></div></div>';
echo '<div class="form-group">
<label class="control-label col-sm-3" for="last_visit">Derniere visite :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="last_visit" id="last_visit"
value="' . htmlspecialchars(time_elapsed($value->member_last_visit)) . '" />
</div></div>';
echo '<div class="form-group">
<label class="control-label col-sm-3" for="avatar">Avatar actuel : <span data-toggle="tooltip" title="Vous pouvez changer l\'avatar du membre dans Update avatar.">' . $this->config->item('fas_circle') . '</span></label>
<div class="col-sm-9">
<img class="img-responsive img-rounded img-fluid img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $value->member_avatar), 40, 40) . '" alt="membre sans avatar"/>
</div></div>';
echo '<div class="form-group">
<label class="control-label col-sm-3" for="signature">Signature :</label>
<div class="col-sm-9">';
echo '<textarea class="form-control" cols=40 rows=4 name="signature" id="signature">
' . htmlspecialchars($value->member_signature) . '</textarea>
</div></div>
</fieldset>
<fieldset>
<legend>Informations Personnelles</legend>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="nom">Nom :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="nom" id="nom"
value="' . htmlspecialchars($value->member_name) . '" /></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="prenom">Prenom :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="prenom" id="prenom"
value="' . htmlspecialchars($value->member_forname) . '" /></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="tel">Telephone :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="tel" id="tel"
value="' . htmlspecialchars($value->member_phone) . '"></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="age">Age :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="age" id="age"
value="' . htmlspecialchars(check_age($value->member_age)) . '"></div></div>';
echo '<div class="form-group">
<label class="control-label col-sm-3" for="sexe">Sexe :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="sexe" id="sexe"
value="' . htmlspecialchars($value->member_gender) . '">
</div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="func">Function :</label>
<div class="col-sm-9">
<input class="form-control" type="text" readonly name="func" id="func"
value="' . htmlspecialchars($value->member_work) . '">
</div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="website">Site Web :</label>
<div class="col-sm-9">';
echo '<input class="form-control" type = "text" name="website" id="website"
value="' . htmlspecialchars($value->member_website) . '"/></div></div>';
echo '<div class="form-group">';
echo '<label class="control-label col-sm-3" for="localisation">Pays :</label>
<div class="col-sm-9">
<input class="form-control" type = "text" readonly name="localisation" id="localisation"
value="' . htmlspecialchars($value->member_location) . '" /></div></div>
</fieldset>';
echo '
<div class="col-sm-3"></div>
<div class="col-sm-9">
<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Modifier" /> |
<input class="btn btn-primary btn-sm" type="reset" value="Effacer"> |
<a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a>
</div> ';
endforeach;
echo form_close();
echo '<br><br>';
break;
case 'update avatar':
$id = isset($id) ? $id : $this->uri->segment(4);
//$id=isset($id)?$id:'';
$pseudo = isset($pseudo) ? $pseudo : '';
$avatar = isset($avatar) ? $avatar : '';
?>
                <ul class="breadcrumb">
                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                    <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                    <li class="active">Avatar Membre</li>
                </ul>
                <hr>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table style="font-size:1.2rem !important"
                        class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>Changer l'avatar du membre: <?= $pseudo ?></th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    A partir de cette page, vous pouver changer l'avatar du membre si l'avatar de
                                    celui-ci est offensif ou inapproprié.<br>
                                    Veuillez selectionner une image sur votre PC. Si vous valider le formulaire sans
                                    selectionner une image, aucune modification ne sera apportée à l'avatar du membre.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?php
if (isset($form_errors)) {
for ($i = 0; $i < sizeof($form_errors); $i++) {
echo '<span style="color:red">' . $form_errors[$i] . '</span><br>';
}
}
echo form_open_multipart('admin/update_avatar/' . $this->idM);
?>
                <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview')
                                .attr('src', e.target.result)
                                .width(100)
                                .height(100);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>
                <hr>
                <div id="selectImage">
                    <p><label>L'avatar actuel du membre <?= $pseudo . nbs(4) ?> <img
                                src="<?= thumb(base_url('assets/avatars/' . $avatar), 40, 40) ?>" alt="avatar membre">
                    </p>
                    <div class="form-group">
                        <input class="form-control input-sm" type="file" name="avatar" onchange="readURL(this);"
                            id="avatar" />
                    </div>
                    <img id="preview" src="#" alt="En attente de selection d'avatar" />
                    <input type="hidden" name="id" value="<?= $id ?>" />
                    <input type="hidden" name="pseudo" value="<?= $pseudo ?>" />
                    <input type="hidden" name="avatar" value="<?= $avatar ?>" />
                    <input class="btn btn-success btn-sm" name="modifier" type="submit" value="Modifier"> | <a
                        class="btn btn-success btn-sm" href="<?= base_url('admin/index/' . $this->idM); ?>">Retour
                        Admin</a>
                </div>
                <?php
echo form_close();
break;
case 'droit member':
?>
                <ul class="breadcrumb">
                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                <li class="active">Niveau Membre </li>
                </ul>
                <hr>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>&Eacute;diter le niveau d'un membre: </th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    A partir de cette page, vous pouver changer le niveau du membre.<br>
                                    A savoir:<br>
                                    niveau banni = 0<br>
                                    niveau visiteur = 1, le niveau de toute personne qui n'est pas connectée qu'il soit
                                    un membre ou un simple visiteur.<br>
                                    niveau supprimé = 2<br>
                                    niveau en attente = 3<br>
                                    niveau membre = 4<br>
                                    niveau modérateur = 5<br>
                                    niveau administrateur = 6<br>
                                    Important:: <br>
                                    veuillez ne pas spécifier le niveau 1, il n'a aucun état dans votre base de
                                    donnée.<br>
                                    Il est marqué dans le champ de la selection par la mention :: <strong>sans
                                        niveau</strong>.</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?php
if ($query->num_rows() > 0) {
$rang = array(
0 => "Banni",
1 => "sans niveau",
2 => "Supprimé",
3 => "En attente",
4 => "Membre",
5 => "Modérateur",
6 => "Administrateur"
);
echo form_open('admin/droit_member/' . $this->idM);
foreach ($query->result_array() as $data) :
switch ($data['member_level']) {
case 0:
	$statu = '<strong style="color:red">Membre Banni</strong>';
	break;
case 1:
	$statu = 'Sans niveau';
	break;
case 2:
	$statu = '<strong style="color:#FF9900"> Membre Supprimé</strong>';
	break;
case 3:
	$statu = '<strong style="color:blue">Membre Inactf</strong>';
	break;
case 4:
	$statu = '<strong style="color:green">Membre Actif</strong>';
	break;
case 5:
	$statu = 'Modérateur';
	break;
case 6:
	$statu = 'Administrateur';
	break;
}
echo '<div class="form-group">';
echo '<label for="droit">Le statut du membre <span style="color:blue">' . $data['member_pseudo'] . '</span> est actuellement :: <strong>';
if (isset($error)) {
echo '<span style="color:red">' . $error . '</span>';
} else {
echo
	$statu;
}
echo '</strong></label>
</div>';
echo '<div class="form-group col-sm-6">';
echo '<select class="form-control input-sm" name="droit">';
for ($i = 0; $i < 7; $i++) {
if ($i == $data['membre_rang']) {
	echo '<option value="' . $i . '" selected="selected">' . $rang[$i] . '</option>';
} else {
	echo '<option value="' . $i . '">' . $rang[$i] . '</option>';
}
}
echo '</select>';
endforeach;
}
echo '</div><div>';
if (isset($member)) {
echo '<input type="hidden" value="' . stripslashes($member) . '" name="member"> ';
} elseif (isset($data['member_pseudo'])) {
echo '<input type="hidden" value="' . stripslashes($data['member_pseudo']) . '" name="member"> ';
}
echo '<input class="btn btn-primary btn-sm" type="submit" name="envoyer" value="Envoyer"> |
<a class="btn btn-primary btn-sm" href="' . base_url('admin/indes' . $this->idM) . '">Annuler</a>
</div>';
echo form_close();
echo br(2);
break;
case 'list bann':
?>
                <ul class="breadcrumb">
                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                    <li class="active">Membres <?= $bread ?></li>
                </ul>
                <hr>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>Liste des membres bannis </th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    Dans cette page sont listés les membres qui ont été sensurés par l'action du
                                    bannissement pour
                                    une raison ou autre. <br>
                                    Veuillez selectionner les cases à cocher pour débannir les membre que vou voulez.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?= form_open('admin/debann/' . $this->idM); ?>
                <table style="font-size:1.2rem; color:#969696;"
                    class="table table-striped table-bordered table-responsive text-center">
                    <thead>
                        <tr>
                            <th class="text-center"><small><strong> id </strong></small></th>
                            <th class="text-center"><small><strong>Pseudo</strong></small></th>
                            <th class="text-center"><small><strong>E-mail</strong></small></th>
                            <th class="text-center"><small><strong>Avatar</strong></small></th>
                            <th class="text-center"><small><strong>Last visite</strong></small></th>
                            <th class="text-center"><small><strong>
                                        <?php if ($query->num_rows() > 0) {
	echo '
<input type="checkbox" id="allbox" name="select">' . nbs(2) . ' <span class="btn btn-primary btn-xs">Select All</span>
<input class="btn btn-primary btn-xs" name="submit" type="submit" value="Débannir" >';
} else {
	echo '<input class="btn btn-primary btn-xs"  data-toggle="tooltip" title="il n\'y a aucun membre à débannir." name="submit" disabled type="submit" value="Débannir" >';
} ?>
                                    </strong></small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
if ($query->num_rows() > 0) {
foreach ($query->result() as $val) :
echo '<tr>
<td>' . htmlspecialchars($val->member_id) . '</td>
<td>' . htmlspecialchars(strtolower($val->member_pseudo)) . '</td>
<td>' . htmlspecialchars(strtolower($val->member_email)) . '</td>
<td>
<img class="img-responsive img-rounded img-fluid img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $val->member_avatar), 30, 30) . '" alt="membre sans avatar"/>
</td>
<td>' . time_elapsed($val->member_last_visit) . '</td>
<td>
<input class="btn btn-primary btn-xs" id="allbox" type="checkbox" value="' . $val->member_id . '" name="membre_id[]">
<input class="btn btn-primary btn-xs" name="submit" type="submit" value="Débannir" ></td>
</tr>
';
endforeach;
echo form_close();
} else {
echo '<tr>
<td colspan="6">' . br(2) . '
<p style="color:green !important" class="text-center">la liste des membres bannis est vide. Vous n\'avez aucun membre banni pour l\'instant.' . br(2) . '
Si vous voulez bannir un membre, cliquez sur : ' . nbs(4) . '
<a href="' . base_url('admin/select_member/' . $this->idM . '/bann') . '" class="btn btn-primary btn-xs">Bannir
un membre</a>' . br(2) . '
</td>
</tr>';
}
echo '<tbody>
</table>';
?>
                        <script>
                        $("#allbox").click(function() {
                            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                        });
                        </script>
                        <?php
break;
case 'bad words':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active">Mots vulgaires</li>
                        </ul>
                        <?php
echo '<hr>
<table style="font-size:1.3rem" class="table table-striped table-responsive">
<tr>
<th>Gestion des mots vulgaires</th>
</tr>
</table>';
echo $link;
echo form_open('admin/badwords/' . $this->idM, 'class="form-inline"');
echo '
<div class="form-group">';
echo '<label for="sort">Trier par : </label>
<select class="form-control input-sm" name="sort" id="sort">
<option value="0">id </option>
<option value="1" >bad word</option>
</select>
</div>
<div class="form-group">
<label for="tri"> Mode : </label>
<select class="form-control input-sm" name="tri" id="tri">
<option value="0" >Croissant</option>
<option value="1" >Décroissant</option>
</select>
</div>
<div class="form-group">
<label for="limit"> Nbr de lignes </label>
<select class="form-control input-sm" name="limit" id="limit">
<option value="10" >10 lignes</option>
<option value="25" >25 lignes</option>
<option value="50" >50 lignes</option>
<option value="100">100 lignes</option>
<option value="500">500 lignes</option>
<option value="1000">1000 lignes</option>
<option value="' . $this->config_model->member_par_page() . '">Défault</option>
</select>
</div>
<div class="form-group">
<input class="btn btn-primary btn-sm" name="envoyer" type="submit" value="Envoyer" />
</div>';
echo form_close();
echo form_open('admin/badwords/' . $this->idM);
echo '<input class="form-control" id="mybad" type="text" placeholder="Recherche rapide ...">';
echo '<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
<thead>
<tr>
<th>id</th>
<th>badword</th>
<th>remplacemen</th>
<th ><span class="btn btn-primary btn-xs"><input data-toggle="tooltip" title="Attendez que la page soit complètement chargée ensuite chochez ce petit carré blan" type="checkbox" id="checkAll">' . nbs(2) . ' Tout selectionner</span>
</th>
<th><p style="text-align:right !important"> <input class="btn btn-primary btn-xs" type="submit" value="Tout supprimer"></th>
</tr>
</thead>
<tbody id="mybadwords">
<tr>
</tr>';
if ($query->num_rows() > 0) {
foreach ($query->result_array() as $data) {
echo '<tr>
<td>' . $data['badword_id'] . '</a></td>
<td>' . $data['badword_word'] . '</td>
<td>' . $data['badword_replace'] . '</td>
<td> <input class="checkbox" type="checkbox" name="delete[]" value="' . $data['badword_id'] . '" />
</td>
<td>
<input class="btn btn-danger btn-xs" type="submit" value="Supprimer">
</td>
</tr>';
}
echo '   <tr>
<td colspan="5">
<p style="text-align:right">  <input class="btn btn-primary btn-xs"  type="submit" value="Tout supprimer">
</td>
</tr>';
} else {
echo '<tr>
<td colspan="5"> Vous n\'avez pas encore defini des mots vulgaire. </td>
</tr>';
}
echo '</tbody></table>';
echo form_close();
echo $link;
?>
                        <script>
                        //select all checkboxes
                        $("#checkAll").change(function() {
                            //"select all" change
                            $(".checkbox").prop('checked', $(this).prop("checked"));
                            //change all ".checkbox" checked status
                        });
                        //".checkbox" change
                        $('.checkbox').change(function() {
                            //uncheck "select all", if one of the listed checkbox item is unchecked
                            if (false == $(this).prop("checked")) { //if this item is unchecked
                                $("#checkAll").prop('checked',
                                    false); //change "select all" checked status to false
                            }
                            //check "select all" if all checkbox items are checked
                            if ($('.checkbox:checked').length == $('.checkbox').length) {
                                $("#checkAll").prop('checked', true);
                            }
                        })
                        </script>
                        <?php
break;
case 'add bad':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active">Membres</li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table style="font-size:1.2rem;" class="table table-responsive table-striped">
                                <tr>
                                    <th>Ajout de mot vulgaire </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            A partir de cette page, vous pouvez ajouter des mots vulgaires à votre
                                            liste des mots sensurés. Le mot vulgaire est sensuré par un masque que vous
                                            désignez vous m&ecirc;me et par n'importe quel caractèea. Vous pouvez
                                            remplacer le mot sensuré aussi carément par un autre mot. Par exemple:[mot
                                            sensuré] </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
echo form_open('admin/add_badwords/' . $this->idM);
echo '<table style="font-size:1.2rem;" class="table table-responsive">
<tr>
<th colspan="2">Ajouter un mots vulgaire</th>
</tr>
<tr>
<td width="10%">';
echo '<label for="ajout"> Mot : </label></td>
<td  width="40%">';
echo form_error('ajout') . '
<input class="form-control" type="text" name="ajout" id="ajout" value="' . set_value('ajout') . '"></td>
<td></td>
</tr>
<tr>
<td><label for="ex">Exemple de masque: </label></td>
<td><input id="ex" type="text" placeholder="Ex 1: [removed], Ex 2: bad-word, Ex 3: ******" readonly class="form-control"></td>
</tr>';
echo '
<td>
<label class"control-label" for="subst">Masque :</label></td>
<td>';
echo form_error('subst') . '
<input class="form-control input-sm" type="text" name="subst" id="subst" value="' . set_value('subst') . '"></td>
<td></td>
</tr>
<tr>
<td colspan="3">
<input class="btn btn-primary btn-sm" type="submit" value="Ajouter"/>
<input class="btn btn-primary btn-sm" type="reset" value="Effacer"/>
<a class="btn btn-primary btn-sm" href="' . $this->agent->referrer() . '"> Retour </a>
</td>
</tr>
</table>';
echo form_close();
break;
case 'ajouter smtp':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active">Ajouter smtp</li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Nouvelle configuration Smtp </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            Cette page, vous permet de configurer votre connexion smtp, si vous n'avez
                                            aucune idée sur cette manière d'envoyer les messages, alors il est temps
                                            d'apprendre et de s'auto-initier sur le sujet ou faire l'auto didacte pour
                                            apprendre davantage. <br>
                                            Dans tout les cas, Si vous rencontrez des problèmes dans la configuration
                                            de votre SMTP, veuillez passez cette méthode.<br>
                                            Si non, à titre d'infos fabb utilise mailjet pour envoyer les emails à ces
                                            membres. Mailjet est un fournisseur de messagie de qualité renommé
                                            mondialement.
                                            Si vous utilisez un autre fournisseur de votre choix tel que Google, vous
                                            devez posséder vos propres identifiants de connexion. <br>Alors veuillez
                                            les rensengneigner dans le formulaire ci-dessous.
                                            <hr>
                                            <p><span style="color:red">IMPORTANT:</span><span
                                                    style="color:#F0F0F0 !important;"> <br>
                                                    1- Le script ne peut ni vérifier ni controller vos informations de
                                                    connexion smtp, veuillez bien les vérifier et les controller avant
                                                    de les valider à risque de voir un message d'echec lors de l'envoi
                                                    de vos messages.</span><br>
                                                <span style="color:#F0F0F0 !important;">
                                                    2- Après la configuration de votre connexion smtp, veuillez
                                                    l'activer en cliquant sur le lien "Activer smtp" dans le m&ecirc;me
                                                    groupe de liens que celui-là.</span></p>
                                            <hr>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-8">
                                <?php echo form_open('admin/add_smtp/' . $this->idM, 'role="form"'); ?>
                                <hr>
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('host'); ?>
                                                <label for="host">Smtp Host <?=$this->config->item('required')?></label>
                                                <input id="host" type="text" name="host"
                                                    value="<?= set_value('host') ?>" class="form-control"
                                                    placeholder="required" data-error="Firstname is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('port'); ?>
                                                <label for="port">Smtp Port <span style="color:red;">*</span></label>
                                                <input id="port" type="text" name="port" class="form-control"
                                                    placeholder="Généralement 465 pour ssl *"
                                                    value="<?= set_value('port') ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('user'); ?>
                                                <label for="user">Smtp User <span style="color:red;">*</span></label>
                                                <input id="user" type="text" name="user" class="form-control"
                                                    placeholder="Nom utilisateur *" value="<?= set_value('user') ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('psw'); ?>
                                                <label for="psw">Smtp Password <span style="color:red;">*</span></label>
                                                <span data-toggle="tooltip"
                                                    title="Le mot de passe sera stocké en claire dans votre base de donnée. Par conséquence, toute personne ayant le droit d'acceder à votre base de donnée peut consulter votre mot de passe."><?= $this->config->item('infos') ?></span>
                                                <input id="psw" value="<?= set_value('psw') ?>" type="password"
                                                    name="psw" class="form-control">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('name'); ?>
                                                <label for="name">Smtp Name <span style="color:red;">*</span></label>
                                                <span data-html="true" data-toggle="tooltip"
                                                    title="Donnez un nom unique à votre connexion.</b> Vous pouvez configurer plusieurs connexion"
                                                    <?= $this->config->item('infos') ?></span> <input
                                                        class="form-control" name="name"
                                                        value="<?= set_value('name') ?>">
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('mailtype'); ?>
                                                <label for="mailtype">Smtp MailType <span
                                                        style="color:red;">*</span></label>
                                                <select id="mailtype" name="mailtype" class="form-control">
                                                    <option value="html">Html</option>
                                                    <option value="text">Text</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('charset'); ?>
                                                <label for="charset">Smtp Charset <span
                                                        style="color:red;">*</span></label>
                                                <input id="charset" type="text" name="charset"
                                                    value="<?= set_value('charset') ?>" class="form-control"
                                                    placeholder="ex: utf-8">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= form_error('crypt'); ?>
                                                <label for="crypte">Smtp Crypt <span style="color:red;">*</span></label>
                                                <select id="crypt" name="crypt" class="form-control">
                                                    <option value="1">SSL</option>
                                                    <option value="2">TLS</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Enregistrer">
                                    </div>
                                </div>
                                <div class="row">
                                    <hr>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <div class="col-md-3"></div>
        </div>
        <?php
break;
//-------------------------------------------------------------------------------------
case 'select smtp':
?>
        <ul class="breadcrumb">
            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
            <li class="active">selection Smtp</li>
        </ul>
        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
            <table style="font-size:1.2rem;" class="table table-responsive table-striped">
                <tr>
                    <th> selection de connexion smtp </th>
                </tr>
                <tr>
                    <td>
                        <p style="color:#F0F0F0 !important;">
                            Cette page vous permet d'éditer votre connexion smtp.<br>Veuillez selectionner la connexion
                            smtp que vous voulez éditer</p>
                    </td>
                </tr>
            </table>
        </div>
        <br><br>
        <?php
if ($query->num_rows() > 0) {
echo '<table style="border:1px solid #6C6C6C;font-size:1.2rem;"  class="table table-bordered table-responsive table-striped">
<tr>
<th>Smtp id</th>
<th>Name</th>
<th>Action</th>
</tr>';
echo form_open('admin/edit_smtp/' . $this->idM);
foreach ($query->result() as $row) :
echo '<tr>
<td>' . $row->smtp_id . '</td>
<td>' . $row->smtp_name . '</td>
<td><a data-toggle="tooltip" title="Supprimer cette connexion" href="' . base_url('admin/delete_smtp/' . $this->idM . '/' . $row->smtp_id . '/' . rawurldecode($row->smtp_name)) . '">' . $this->config->item('delete') . '</a> |
<a data-toggle="tooltip" title="&Eacute;diter cette connexion" href="' . base_url('admin/edited_smtp/' . $this->idM . '/' . $row->smtp_id) . '">' . $this->config->item('edit') . '</a>
</td>
</tr>';
endforeach;
echo '</table>
<br>
<input type="submit" class="btn btn-primary btn-sm" value="Envoyer">';
echo form_close();
} else {
echo '  <table style="border:1px solid #6C6C6C;font-size:1.2rem;"  class="table table-bordered table-responsive table-striped">
<tr>
<th>Smtp id</th>
<th>Name</th>
<th>Action</th>
</tr>
<td colspan="3">
<p style=" text-align:justify;padding:10px 20px;">
<span style="color:red">Important ::</span><br>
Aucune connexion smtp n\'est installé sur votre serveur pour l\'instant.<br>
Si vous pocédez déjà vos identifiants de connexion smtp, veuillez cliquez sur le bouton ci-dessous <br>
pour configurer votre connexion <br><br>
<a class="btn btn-primary btn-sm" href="' . base_url('admin/add_smtp/' . $this->idM) . '">Configurer smtp</a></p>
</td>
</tr>
</table>';
}
break;
case 'edit smtp':
?>
        <ul class="breadcrumb">
            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
            <li class="active">SMTP</li>
        </ul>
        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
            <table class="table table-responsive table-striped containerbox">
                <tr>
                    <th>&Eacute;dition Smtp </th>
                </tr>
                <tr>
                    <td>
                        <p style="color:#F0F0F0 !important;">
                            Dans cette page, vous pouvez éditer votre connexion smtp.<br>
                            Le nom de la connexion (smtp name) ne peut &ecirc;tre éditer, Si vous &ecirc;tes dans
                            l'obligation de modifier le nom de la connexion, vous devez d'abord supprimer la dite
                            connexion, ensuite re-configurez la avec un autre nom.
                            <hr>
                            <p></p><span style="color:red">IMPORTANT:</span><span style="color:#F0F0F0 !important;"> Le
                                script ne peut ni vérifier ni controller vos informations de connexion smtp, veuillez
                                bien les vérifier et les controller avant de les valider à risque de voir un message
                                d'echec lors de l'envoi de vos messages. </span>
                            <hr>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <?php
if ($query->num_rows() > 0) {
foreach ($query->result() as $val) {
$smtp_id = $val->smtp_id;
$name = $val->smtp_name;
$host = $val->smtp_host;
$port = $val->smtp_port;
$user = $val->smtp_user;
$psw = $val->smtp_psw;
$crypt = $val->smtp_crypt;
$mailtype = $val->smtp_mailtype;
$charset = $val->smtp_charset;
}
} else {
$name = set_value('name');
$host = set_value('host');
$port = set_value('port');
$user = set_value('user');
$psw = set_value('psw');
$crypt = set_value('crypt');
$mailtype = set_value('mailtype');
$charset = set_value('charset');
$smtp_id = set_value('smtp_id');
}
?>
                <?php echo form_open('admin/edited_smtp/' . $this->idM, 'role="form"'); ?>
                <br><br>
                <div class="controls">
                    <div class="row">
                        <div class="form-group">
                            <?= form_error('name'); ?>
                            <label for="name">Smtp Name</label>
                            <input readonly class="form-control" name="name" value="<?= $name ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('host'); ?>
                                <label for="host">Smtp Host <?=$this->config->item('required')?></label>
                                <input id="host" type="text" name="host" value="<?= $host; ?>" class="form-control"
                                    placeholder="required" data-error="Firstname is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('port'); ?>
                                <label for="port">Smtp Port<?=$this->config->item('required')?></label>
                                <input id="port" type="text" name="port" class="form-control"
                                    placeholder="Généralement 465 pour ssl *" value="<?= $port; ?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('user'); ?>
                                <label for="user">Smtp User <span style="color:red;">*</span></label>
                                <input id="user" type="text" name="user" class="form-control"
                                    placeholder="Nom utilisateur *" value="<?= $user; ?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('psw'); ?>
                                <label for="psw">Smtp Password <span style="color:red;">*</span></label> <span
                                    data-toggle="tooltip"
                                    title="Le mot de passe sera stocké en claire dans votre base de donnée. Par conséquence, toute personne ayant le droit d'acceder à votre base de donnée peut consulter votre mot de passe."><?= $this->config->item('fas_circle') ?></span>
                                <input id="psw" value="<?= $psw; ?>" type="password" name="psw" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mailtype">Actuel MailType </label>
                                <input id="mailtype" type="text" name="mailtype" value="<?= $mailtype; ?>"
                                    class="form-control" readonly>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('mailtype'); ?>
                                <label for="mailtype">Smtp MailType <span style="color:red;">*</span></label>
                                <select id="mailtype" name="mailtype" class="form-control">
                                    <option value="html">Html</option>
                                    <option value="text">Text</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('charset'); ?>
                                <label for="charset">Smtp Charset <span style="color:red;">*</span></label>
                                <input id="charset" type="text" name="charset" value="<?= $charset; ?>"
                                    class="form-control" placeholder="ex: utf-8">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= form_error('crypt'); ?>
                                <label for="crypte">Smtp Crypt <span style="color:red;">*</span></label>
                                <select id="crypt" name="crypt" class="form-control">
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="smtp_id" value="<?php if (isset($smtp_id)) echo $smtp_id;
					else echo $id; ?>">
                        <input type="submit" name="edit" class="btn btn-primary btn-sm" value="Enregistrer">
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
            </div>
            <?= form_close() ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <?php
break;
//-------------------------------------------------------------------------------------
case 'avtive smtp':
?>
    <ul class="breadcrumb">
        <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
        <li class="active">Active Smtp</li>
    </ul>
    <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
        <table class="table table-responsive table-striped containerbox">
            <tr>
                <th> Configurer l'envoi des email </th>
            </tr>
            <tr>
                <td>
                    <p style="color:#F0F0F0 !important;">
                        Cette page vous permet de choisir votre connexion smtp qui sera utilisée par défaut.<br>
                        Si vous avez déjà configuré votre connexion smtp, sachez que vous avez (02) deux options pour
                        envoyer vos message<br>
                        Option 1 :: selectionnez Désactiver pour utiliser la fonction simple sendMail().<br>
                        Option 2 :: selectionnez la connexion smtp de votre choix qui sera utilisée lors de l'envoi de
                        vos méssages.</p>
                    <p style="color:#F0F0F0 !important;">Votre connexion smtp utilisée actuellement est :: <strong><?php if (isset($active)) echo $active;
																	else echo 'sendMail'; ?> </strong></p>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <?php
echo form_open('admin/active_smtp/' . $this->idM);
if ($smtp->num_rows() > 0) {
echo ' <div class="row">
<div class="form-group col-md-6">';
echo form_error('choix');
echo '<label for="choix">Active smtp</label>';
echo ' <select class="form-control" name="choix" id="choix">';
echo '<option value="choisir">choisir</option>';
echo '<option value="0">Désactiver</option>';
foreach ($smtp->result() as $rows) :
echo '<option value="' . $rows->smtp_id . '">' . $rows->smtp_name . '</option>';
endforeach;
echo '</select>
</div></div>';
echo '<div class="row">
<div class="form-group">
<input type="submit" name="valider" class="btn btn-primary btn-sm" value="Valider">
<a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Annuler </a>
</div></div>';
echo form_close();
} else {
echo '<p>Aucune connexion smtp n\'est installé sur votre serveur pour l\'instant.<br>
Si vous pocédez déjà vos identifiants de connexion smtp, veuillez cliquez sur le bouton ci-dessous <br>
pour configurer votre connexion </p>
<p><a class="btn btn-primary btn-sm" href="' . base_url('admin/smtp/' . $this->idM) . '">Configurer smtp</a></p>';
}
break;
//-------------------------------- list friends -------------------------
case 'abus':
?>
    <ul class="breadcrumb">
        <li><a href="<?= base_url('forum') ?>">Forum</a></li>
        <li><a href="<?= base_url('member') ?>">U-panel</a></li>
        <li><a>Rapport d'abus</a></li>
    </ul>
    <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
        <table style="font-size:1.2rem" class="table table-responsive table-striped">
            <tr>
                <th>Rapports abus</th>
            </tr>
            <tr>
                <td>
                    <br>
                    <p style="color:#F0F0F0 !important;">
                        Dans cette page vous recevez les messages des membres qui vous ont envoyé des rapports
                        concernants leurs<br>
                        expériences de navigation sur le forum.
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <?php
if ($query->num_rows() > 0) {
echo '
<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
<tr>
<th>&Eacute;tat</th>
<th>Titre</th>
<th>Expéditeur</th>
<th>Date</th>
<th>Connecté</th>
<th>Action</th>
</tr>';
foreach ($query->result() as $data) : {
echo '<tr>';
if ($data->contact_read == 0) {
	echo '<td><img src="' . base_url('assets/img/msg_non_lu.png') . '" alt="Non lu" /></td>';
} else {
	echo '<td>
<img src="' . base_url('assets/img/msg_deja_lu.png') . '" alt="Déja lu" /></td>';
}
echo '<td>';
// <a href="./messagesprives.php?action=consulter&amp;id='.$data->mp_id.'">
echo '<p><a data-toggle="tooltip" title="Cliquez pour lire le méssage envoyé par ' . htmlspecialchars($data->member_pseudo) . '" href="' . base_url('admin/read_abus/' . $this->idM . '/' . $data->contact_id) . '">
' . htmlspecialchars($data->contact_object) . '</a></p></td>
<td id="mp_expediteur">
<a href="' . base_url('visit/profil/' . $this->idM . '/' . $data->contact_idm) . '">
' . htmlspecialchars($data->member_pseudo) . '</a></td>
<td id="mp_time">' . date('\l\e d M Y \à  H:i:s', $data->contact_date) . '</td>';
if (!empty($data->online_id))
	echo '<td>' . $this->config->item('wifi_on') . '</td>';
else
	echo '<td>' . $this->config->item('wifi_off') . '</td>';
echo '<td>';
echo '<a data-toggle="tooltip" title="Cliquez pour supprimer ce méssage" href="' . base_url('delete/abus/' . $this->idM . '/' . $data->contact_id . '/msg') . '">' . $this->config->item('delete') . '</a>
</td></tr>';
} //Fin de la boucle
endforeach;
echo '</table>';
} else {
echo '
<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
<tr>
<th>&nbsp;</th>
<th>Titre</th>
<th>Expéditeur</th>
<th>Date</th>
<th>Action</th>
</tr>
<tr>
<td colspan="5">
<p class="text-center">Vous n\'avez aucun rapport d\'abus pour l\'instant.</p><br><br>
<p class="text-center"><a class="btn btn-success btn-sm" href="' . base_url('panel/index/' . $this->idM) . '">Retour U-Panel</a></p></td>
</tr>
</table>';
}
break;
//---------------------------------------- consulter -----------------------------------------------
case 'read abus':
?>
    <ul class="breadcrumb">
        <li><a href="<?= base_url('forum') ?>">Forum</a></li>
        <li><a href="<?= base_url('member') ?>">U-panel</a></li>
        <li><a>Consulter rapport</a></li>
    </ul>
    <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
        <table style="font-size:1.2rem" class="table table-responsive table-striped">
            <tr>
                <th>Lire rapport d'un membre</th>
            </tr>
            <tr>
                <td>
                    <br>
                    <p style="color:#F0F0F0 !important;">
                        Dans cette page vous consulter les rapports envoyés par vos membres.
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <?php
foreach ($query->result() as $data) :
echo '<p><a href="' . $this->agent->referrer() . '">
<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Retour page précédente">Retour</button></a>';
echo '<a href="' . base_url('reply/pm/' . $this->idM . '/' . $data->contact_idm . '/' . $data->member_pseudo) . '">
<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Répondre à ce message">Répondre</button></a></p>';
?>
    <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
        <tr>
            <th>Auteur</th>
            <th>Message</th>
        </tr>
        <tr>
            <td>
                <?php
echo '<a href="' . base_url('guest/profil/' . $data->member_id) . '">' . $data->member_pseudo . '</a></td>
<td>Posté à ' . date('H\hi \m\i\n \l\e d M Y', $data->contact_date) . '</td>
</tr>
<tr>
<td>';
echo '<p><img class="img-circle" src="' . thumb(base_url('assets/uploads/' . $data->member_avatar), 40, 40) . '" alt="avatar" />
<br />Inscrit le : ' . date('d/m/Y', $data->member_registred) . '
<br />Post(s) : ' . $data->member_post . '
<br />Pays : ' . htmlspecialchars($data->member_location) . '</p>
</td>
<td>';
echo nl2br($this->bbcode->netcode($data->contact_text)) . '
<hr />' . nl2br($data->member_signature) . '
</td>
</tr>
</table>';
endforeach;
break;
//-------------------------------------- mail member --------------------------------------------
case 'tester email':
if (isset($smtp_name)) {
$conn = $smtp_name;
} else {
$conn = 'sendMail';
}
?>
                <ul class="breadcrumb">
                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                    <li class="active">Tester email</li>
                </ul>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>Tester l'envoi réel d'email </th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    Cette page vous permet d'envoyer un message test à vous m&ecirc;me.<br>
                                    Si vous voulez envoyer des messages réels à un membre ou un groupe de membre,
                                    veuillez cliquer sur les liens "Envoi simple" ou "Envoi en masse" dans ce
                                    m&ecirc;me groupe de liens.<br>
                                    Vous utilisez actuellement la connexion smtp ::<strong> <?= $conn ?></strong>
                            </td>
                        </tr>
                    </table>
                </div>
                <br><br>
                <?= form_open('admin/test_email/' . $this->idM, 'class="form-horizontal"'); ?>
                <div class="form-group">
                    <label for="to" class="col-sm-1 control-label">To:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control input-sm" name="to"
                            value="<?= $this->config_model->admin_contact() ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="from" class="col-sm-1 control-label">From:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control input-sm" name="from"
                            value="<?= $this->config_model->admin_contact() ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objet" class="col-sm-1 control-label">Objet:</label>
                    <div class="col-sm-6">
                        <input type="text" name="objet" readonly value="Test message" class="form-control input-sm"
                            id="objet" placeholder="Objet du message">
                    </div>
                </div>
                <?= form_error('message'); ?>
                <div class="form-group">
                    <label for="message" class="col-sm-1 control-label">Message</label>
                    <div class="col-sm-6">
                        <textarea style="text-align:left;" class="form-control" id="message" name="message">
Veuillez rédiger un cours méssage pour l'envoyer à
vous m&ecirc;me. Si non, cliquez sur envoyer pour
valider le présent texte.
</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label"></label>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-primary btn-sm" name="submit_mail" value="Envoyer">
                        <input type="reset" class="btn btn-primary btn-sm" value="Effacer">
                        <a href="<?= base_url('admin') ?>" class="btn btn-primary btn-sm">Retour Admin</a>
                    </div>
                </div>
                <?php
echo form_close();
break;
//---------------------------------- masse email --------------------------
case 'masse mail':
?>
                <ul class="breadcrumb">
                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                    <li class="active"><?= $bread ?></li>
                </ul>
                <hr>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>Envoyer email en masse </th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    Dans cette page sont listés tout les membres présents dans votre base ce données.
                                    <br>
                                    Veuillez selectionner les cases à cocher des membres pour lesquels vous voulez
                                    envoyer votre méssage.<br>
                                    Si non vous pouvez selectionner toute la liste des membres en cochant la case à
                                    cocher du bouton :: Tout selectionner.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?= form_open('admin/masse_mail/' . $this->idM);
if (isset($error)) {
echo '<p style="color:red !important;">' . $error . '</p>';
}
?>
                <p><strong>Votre base de donnée contient actuellement :: <?= $query->num_rows() ?> Membres</strong></p>
                <p><input class="btn btn-primary btn-xs" name="Envoyer_mail" type="submit" value="Envoyer"></p>
                <table style="font-size:1.2rem; color:#969696;"
                    class="table table-striped table-bordered table-responsive text-center">
                    <thead>
                        <tr>
                            <th class="text-center"><small><strong> id </strong></small></th>
                            <th class="text-center"><small><strong>Pseudo</strong></small></th>
                            <th class="text-center"><small><strong>E-mail</strong></small></th>
                            <th class="text-center"><small><strong>Avatar</strong></small></th>
                            <th class="text-center"><small><strong>Last visite</strong></small></th>
                            <th class="text-center">
                                <?php if ($query->num_rows() > 0) {
echo '
<span class="btn btn-primary btn-xs"> <input type="checkbox" id="allmembers" name="allmembers"> Tout selectionner</span>';
} else {
echo '<input class="btn btn-primary btn-xs"  data-toggle="tooltip" title="il n\'y a aucun membre à selectionner." name="submit" disabled type="submit" value="Aucun membre" >';
} ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
if ($query->num_rows() > 0) {
foreach ($query->result() as $val) :
echo '<tr>
<td>' . htmlspecialchars($val->member_id) . '</td>
<td>' . htmlspecialchars(strtolower($val->member_pseudo)) . '</td>
<td>' . htmlspecialchars(strtolower($val->member_email)) . '</td>
<td>
<img class="img-responsive img-rounded img-fluid img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $val->member_avatar), 30, 30) . '" alt="membre sans avatar"/>
</td>
<td>' . time_elapsed($val->member_last_visit) . '</td>
<td>
<input class="btn btn-primary btn-xs" id="allmembers" type="checkbox" value="' . $val->member_email . '" name="mailto[]">
</td></tr>';
endforeach;
echo form_close();
} else {
echo '<tr>
<td colspan="6">' . br(2) . '
<p style="color:green !important" class="text-center">Votre base de donnée est vide. Vous n\'avez aucun membre pour l\'instant.
</td>
</tr>';
}
echo '<tbody>
</table>
<p><input class="btn btn-primary btn-xs" name="Envoyer_mail" type="submit" value="Envoyer" ></p>
';
?>
                        <script>
                        $("#allmembers").click(function() {
                            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                        });
                        </script>
                        <?php
break;
//----------------------- statistic ----------------------------------------
case 'statistic':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active">Statistiques</li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Résumé de statistique du forum</th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            Dans cette page vous trouverez quelques statistiques du forum<br>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br><br>
                        <?php
$j = 1;
if (isset($list_forum)) {
echo '<table style="color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
<caption>Liste des forum</caption>
<tr>
<th>ordre</th>
<th>Forum</th>
<th>Nbre Topic</th>
<th>Nbre Post</th>
</tr>';
foreach ($list_forum->result() as $row) :
echo '<tr>';
echo '<td>' . $j . '</td>';
echo '<td>' . $row->forum_name . '</td>';
echo '<td>' . $row->forum_topic . '</td>';
echo '<td>' . $row->forum_post . '</td>';
echo '</tr>';
$j++;
endforeach;
echo '</table>';
}
if ($totalMembers == 1) {
$total = 'membre';
} else {
$total = 'membres';
}
echo '
<table style="color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-responsive">
<tr>
<th colspan="6">Total Des Membres: le forum compte actuellement <span style="color:blue">' . $totalMembers . ' </span>' . $total . ' </th>       </tr>
<tr>
<td>Bannis</td>
<td>Supprimés</td>
<td>Inactifs</td>
<td>Actifs</td>
<td>Modérateur</td>
<td>Administrateur</td>
</tr>
<tr>
<td>' . $banned->num_rows() . '</td>
<td>' . $deleted->num_rows() . '</td>

<td>' . $pending->num_rows() . '</td>
<td>' . $actif->num_rows() . '</td>
<td>' . $modo->num_rows() . '</td>
<td>' . $admin->num_rows() . '</td>
</tr></table>';
echo '
<table style="color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-responsive">
<tr>
<th>Total des visiteurs </th>
</tr>
</table>';
echo '<table style="color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
<tr>
<th style="text-align:center !important;"> En ligne</th>
<th style="text-align:center !important;">Derniere 24 heures</th>
<th style="text-align:center !important;">Derniers 7 jours</th>
<th style="text-align:center !important;">Derniers 30 jours</th>
<th style="text-align:center !important;">Derniers 365 jours</th>
<th style="text-align:center !important;">tout les temps</th>
</tr>
<tr>
<td style="text-align:center !important;">' . $online->num_rows() . '</td>
<td style="text-align:center !important;">' . $day . '</td>
<td style="text-align:center !important;">' . $week . '</strong></td>
<td style="text-align:center !important;">' . $month . '</td>
<td style="text-align:center !important;">' . $year . '</td>
<td style="text-align:center !important;">' . $all_time . '</td>
</tr>
</table>';
echo '
<table style="text-align:center;color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-responsive">
<tr>
<th>Détails des visiteurs en ligne</th>
</tr>
</table>';
echo '<table style="text-align:center;color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
<tr>
<th>Adresse IP</th>
<th>Depuis</th>
<th>Pays</th>
<th>city</th>
<th>code</th>
<th>Platform</th>
<th>Navigateur</th>
</tr>';
if ($data_online->num_rows() > 0) {
foreach ($data_online->result() as $val) :
echo '<tr>
<td>';
if ($this->ip == $val->online_ip) {
echo '<strong style="color:red;">Votre IP :: </strong>' . $val->online_ip;
} else {
echo $val->online_ip;
}
echo '</td>
<td>' . date('H:i:s', $val->online_time) . '</td>
<td>' . $val->online_country . '</td>
<td>' . $val->online_city . '</td>
<td>' . $val->online_code . '</td>
<td>' . $val->online_platform . '</td>
<td>' . $val->online_browser . '</td>
</tr> ';
endforeach;
} else {
echo '<tr>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
</tr> ';
}
echo ' </table>';
echo '
<table style="text-align:center;color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-responsive">
<tr>
<th>Détails visiteurs 24 heures</th>
</tr>
</table>';
echo '<table style="text-align:center;color:#6C6C6C;font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
<tr>
<th>Adresse IP</th>
<th>Heure</th>
<th>Pays</th>
<th>city</th>
<th>code</th>
<th>Platform</th>
<th>Navigateur</th>
</tr>';
if ($data_day->num_rows() > 0) {
foreach ($data_day->result() as $val) :
echo '<tr>
<td>';
if ($this->ip == $val->online_ip) {
echo '<strong style="color:red;">Votre IP :: </strong>' . $val->online_ip;
} else {
echo $val->online_ip;
}
echo '</td>
<td>' . date('H:i:s', $val->online_time) . '</td>
<td>' . $val->online_country . '</td>
<td>' . $val->online_city . '</td>
<td>' . $val->online_code . '</td>
<td>' . $val->online_platform . '</td>
<td>' . $val->online_browser . '</td>
</tr> ';
endforeach;
} else {
echo '<tr>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
<td>Null</td>
</tr> ';
}
echo ' </table>';
break;
//-------------------------------------------------------------------------------
case 'inactifs':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                            <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active">Membres <?php //$bread ?></li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table style="font-size:1.2rem" class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Liste des membres inactifs </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            Par défaut, l'inactivité d'un membre est configurée à 6 mois. vous pouvez
                                            changer cette valeur en cliquant sur le lien juste à gauche ::
                                            configuration. <br>
                                            Important ::<br>
                                            La configuration de la période d'inavtivité est exprimée en mois.<br>
                                            Exemple:<br>
                                            1 mois = 1<br>
                                            6 mois = 6<br>
                                            1 an = 12<br>
                                            2 ans = 24<br>
                                            illimité = 0, la période d'inactivité doit &ecirc;tre un chiffre
                                            entier.<br>
                                            <hr>
                                            <p style="color:#F0F0F0 !important;">
                                                Dans cette page, les options disponibles sont:<br>
                                                Aviser: envoyer un méssage interne au membre inactif, s'il se connecte
                                                entre temps, il s'aura le méssage et de cette manière vous encouragez
                                                les membres à contribuer sur votre forum au lieu de les supprimer.<br>
                                                Alerter: le m&ecirc;me principe mais en envoyant au membre un méssage
                                                externe (à sa boite email avec laqu'elle il s'est enregistré).<br>
                                                Supprimer: supprime le compte du membre inactif.
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
echo br(2);
echo form_open('admin/inactif/' . $this->idM, 'class="form-inline"');
echo '
<div class="form-group">';
echo '<label for="tri">Trier par : </label>
<select class="form-control input-sm" name="tri" id="tri">
<option value="0">Membre id </option>
<option value="1" >Pseudo</option>
<option value="2" >Nbre Messages</option>
<option value="3">Dernière visite</option>
</select>
</div>
<div class="form-group">
<label for="order"> Mode : </label>
<select class="form-control input-sm" name="order" id="order">
<option value="0" >Croissant</option>
<option value="1" >Décroissant</option>
</select>
</div>
<div class="form-group">
<input class="form-control input-sm" name="envoyer" type="submit" value="Envoyer" />
</div>';
echo form_close();
echo br(2);
if ($query->num_rows() > 0) {
?>
                        <br>
                        <input class="form-control" id="myInput" type="text" placeholder="Recherche rapide ...">
                        <br>
                        <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr style="color:#6F6F6F;">
                                    <th class="text-center"><small><strong> id </strong></small></th>
                                    <th class="text-center"><small><strong>Pseudo</strong></small></th>
                                    <th class="text-center"><small><strong>Avatar</strong></small></th>
                                    <th class="text-center"><small><strong>Inscrit depuis</strong> </small></th>
                                    <th class="text-center"><small><strong>Dernière visite</strong></small></th>
                                    <th class="text-center"><small><strong>Etat</strong></small></th>
                                    <th class="text-center"><small><strong>Action</strong></small></th>
                                </tr>
                            </thead>
                            <tbody id="inactif">
                                <?php
foreach ($query->result() as $value) {
echo '<tr style="color:#6F6F6F;">
<td>' . htmlspecialchars($value->member_id) . '</td>
<td>
<a href="' . base_url('guest/profil/') . $value->member_id . '">
' . htmlspecialchars($value->member_pseudo) . '</a></td>
<td><img class="img-fluid img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $value->member_avatar), 25, 25) . '">              </td>
<td>' . date('d-M-Y', $value->member_registred) . '</td>';
echo '<td>' . elapsed(time() - $value->member_last_visit) . '</td>';
switch ($value->member_level) {
case 2:
	$state = '<button class="btn btn-danger btn-xs">Compte Supprimé</button>';
	break;
case 3:
	$state = '<button class="btn btn-warning btn-xs">Compte en attente</button>';
	break;
case 4:
	$state = '<button class="btn btn-success btn-xs">' . nbs(4) . 'Compte Actif' . nbs(4) . '</button>';
	break;
case 5:
	$state = '<button class="btn btn-success btn-xs">' . nbs(4) . 'Compte Actif' . nbs(4) . '</button>';
	break;
}
echo '<td>' . $state . '</td>';
echo '
<td>
<a class="btn btn-warning btn-xs" href="' . base_url('admin/aviser/' . $this->idM . '/' . $value->member_id . '/' . rawurlencode($value->member_pseudo)) . '">Aviser</a> |
<a class="btn btn-warning btn-xs" href="' . base_url('admin/alerter/' . $this->idM . '/' . rawurlencode($value->member_pseudo)) . '">Alerter</a> |
<a class="btn btn-danger btn-xs" href="' . base_url('admin/delete_member/' . $this->idM . '/' . rawurlencode($value->member_pseudo)) . '">Supprimer </a></td>';
echo '<td></td>
</tr>';
}
?>
                            </tbody>
                        </table>
                        <?php
} else {
?>
                        <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr style="color:#6F6F6F;">
                                    <th class="text-center"><small><strong> id </strong></small></th>
                                    <th class="text-center"><small><strong>Pseudo</strong></small></th>
                                    <th class="text-center"><small><strong>Avatar</strong></small></th>
                                    <th class="text-center"><small><strong>Inscrit depuis</strong> </small></th>
                                    <th class="text-center"><small><strong>Dernière visite</strong></small></th>
                                    <th class="text-center"><small><strong>Action</strong></small></th>
                                </tr>
                            </thead>
                            <tbody id="inactif">
                                <tr style="color:#6F6F6F;">
                                    <td colspan="6">
                                        <p
                                            style="text-align:center !important; color: rgb(54,167,48)!important; padding:20px 20px !important;">
                                            Félicitation, le forum ne contient aucun membre inactif<br>
                                            aucune action n'est solicité de votre part.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
}
break;
//-------------------------------------------- add pub-----------------------------------------
case 'pub':
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active"><?= $bread ?></li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Ajouter une publicité </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            A partir de cette page, vous pouvez ajouter des publicités à votre forum.
                                            Les pages suceptibes de contenir des pub sont limité, vu le gabarit des
                                            forums qui est totalement différent des autres pages du web, il ne permet
                                            pas d'insérer les pub n'importe où ou encore n'importe comment.<br>
                                            les pages sur lequelle vous pouver insérer la pub sont listées dans le
                                            formulaire ci-dessous. Les pub seront injectées selon votre choix dans:<br>
                                            1- le haut de la page.<br>
                                            2- Au bas de la page.<br>
                                            Si vous insérer plusieurs pub au m&ecirc;me endroit, les pub seront
                                            affichées aléatoirement. c'est à dire, à chaque rechargement de la page une
                                            seule pub (parmis les pub éxistentes) sera affichéé.<br>
                                            Les bannières seront redimentionnées automatiquent pour les appareils
                                            mobiles et tablettes. &Agrave; votre connaissance, nous avons pris en
                                            consédération seulement les formats standards des bannières.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br><br>
                        <?= form_open('admin/pub/' . $this->idM) ?>
                        <div class="form-group">
                            <?= form_error('title') ?>
                            <label for="objet" class="col-sm-3 control-label">Titre de la Pub <span data-html="true"
                                    title="Champ obligatoire."
                                    data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="title" value="<?= set_value('title'); ?>"
                                    class="form-control input-sm" id="objet"
                                    placeholder="Donnez un titre à votre bannière de pub">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <?= form_error('format') ?>
                            <label class="col-sm-3 control-label" for="format">Format de la pub <span data-html="true"
                                    title="Champ obligatoire."
                                    data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                            <div class="col-sm-6">
                                <select class="form-control input-sm" name="format" id="format">
                                    <option value="choisir">choisir </option>
                                    <option <?php if (set_value('format') == "88x31") echo 'selected'; ?> value="88x31">
                                        88 x 31 px </option>
                                    <option <?php if (set_value('format') == "120x90") echo 'selected'; ?>
                                        value="120x90">120 x 90 px </option>
                                    <option <?php if (set_value('format') == "234x60") echo 'selected'; ?>
                                        value="234x60">234 x 60 px </option>
                                    <option <?php if (set_value('format') == "320x50") echo 'selected'; ?>
                                        value="320x50">320 x 50 px</option>
                                    <option <?php if (set_value('format') == "468x60") echo 'selected'; ?>
                                        value="468x60">468 x 60 px </option>
                                    <option <?php if (set_value('format') == "728x90") echo 'selected'; ?>
                                        value="728x90">728 x 90 px</option>
                                    <option <?php if (set_value('format') == "970x90") echo 'selected'; ?>
                                        value="970x90">970 x 90 px</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <?= form_error('page') ?>
                            <label class="col-sm-3 control-label" for="page">Page de destination <span data-html="true"
                                    title="Champ obligatoire."
                                    data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                            <div class="col-sm-6">
                                <select class="form-control input-sm" name="page" id="page">
                                    <option value="choisir">choisir </option>
                                    <option <?php if (set_value('page') == "index") echo 'selected'; ?> value="index">
                                        index forum </option>
                                    <option <?php if (set_value('page') == "forum") echo 'selected'; ?> value="forum">
                                        voir forum</option>
                                    <option <?php if (set_value('page') == "topic") echo 'selected'; ?> value="topic">
                                        page topic</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <?= form_error('pos') ?>
                            <label class="col-sm-3 control-label" for="position">Position <span data-html="true"
                                    title="Champ obligatoire."
                                    data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                            <div class="col-sm-6">
                                <select class="form-control input-sm" name="position" id="position">
                                    <option value="choisir">choisir </option>
                                    <option <?php if (set_value('position') == "top") echo 'selected'; ?> value="top">
                                        Haut de page</option>
                                    <option <?php if (set_value('position') == "bottom") echo 'selected'; ?>
                                        value="bottom">Bas de page</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <?= form_error('code') ?>
                            <label for="code" class="col-sm-3 control-label">code Html de la Pub <span data-html="true"
                                    title="Attention:<br>Vous devez &ecirc;tre s&ucirc;r du code html de votre bannière."
                                    data-toggle="tooltip"><?= $this->config->item('fas_info') ?></span></label>
                            <div class="col-sm-6">
                                <textarea type="text" name="code" id="code" class="form-control input-sm">
<?= set_value('code'); ?>
</textarea>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> </label>
                            <div class="col-sm-6">
                                <input type="submit" value="Envoyer" class="btn btn-primary btn-sm col-sm-3">
                            </div>
                        </div>
                        <?= form_close() ?>
                        <br><br>
                        <?php
break;
//-------------------------------------------- gerer pub ----------------------------------------------
case 'gerer pub':
$atts = array(
'width'       => 800,
'height'      => 600,
'scrollbars'  => 'yes',
'status'      => 'yes',
'resizable'   => 'yes',
'screenx'     => 0,
'screeny'     => 0,
'window_name' => '_blank',
'class' => 'btn btn-default btn-xs',
'data-html' => "true",
'data-toggle' => "tooltip",
'data-title' => "Voir un rendu de cette pub"
);
?>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                            <li class="active"><?= $bread ?></li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Gestion de la publicité </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            A partir de cette page, vous pouvez apporter les différentes modifications
                                            à vos bannières de publicité. il suffit de cliquer sur le lien adéquats
                                            pour gérer vos modifications.<br>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br><br>
                        <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr style="color:#6F6F6F;">
                                    <th class="text-center"><small><strong> Ordre </strong></small></th>
                                    <th class="text-center"><small><strong>Page </strong></small></th>
                                    <th class="text-center"><small><strong>Position</strong></small></th>
                                    <th class="text-center"><small><strong>Titre Pub</strong> </small></th>
                                    <th class="text-center"><small><strong>Date insertion</strong></small></th>
                                    <th class="text-center"><small><strong>&Eacute;tat</strong></small></th>
                                    <th class="text-center"><small><strong>Action</strong></small></th>
                                </tr>
                            </thead>
                            <tbody id="inactif">
                                <?php
if ($gererpub->num_rows() > 0) {
foreach ($gererpub->result() as $value) {
if ($value->add_stat == 1) {
$stat_pub = 'active';
$etat = '<span style="color:green">Active</span>';
} else {
$stat_pub = 'In-active';
$etat = '<span style="color:red">In-active</span>';
}
if ($stat_pub == 'active') {
$lock = '<span style="font-size:12px; color:red;" data-html="true" data-toggle="tooltip"
data-title="Cette pub est activée.<br> Cliquez sur le bouton pour la désactiver">' . $this->config->item('lock') . '</span>';
$link = 'admin/lock_pub';
} else {
$lock = '<span style="font-size:12px; color:green;" data-html="true" data-toggle="tooltip" data-title="Cette pub
est désactivée.<br>Cliquez sur le bouton pour l\'activer">' . $this->config->item('lock_open') . '</span>';
$link = 'admin/unlock_pub';
}
echo '<tr style="color:#6F6F6F;">
<td>' . htmlspecialchars($value->add_id) . '</td>
<td>' . htmlspecialchars($value->add_page) . '</td>
<td>' . htmlspecialchars($value->add_position) . ' </td>
<td>' . htmlspecialchars($value->add_title) . '</td>
<td>' . time_elapsed($value->add_date) . '</td>
<td>' . $etat . '</td>
<td>
<a class="btn btn-default btn-xs" href="' . base_url($link . '/' . $this->idM . '/' . $value->add_id) . '">' . $lock . '</a> |
<a data-html="true" data-toggle="tooltip" data-title="Editer la pub" class="btn btn-default btn-xs" href="' . base_url('admin/edit_pub/' . $this->idM . '/' . $value->add_id) . '">' . $this->config->item('edit') . '</a> |
<a data-html="true" data-toggle="tooltip" data-title="Supprimer cette pub" class="btn btn-default btn-xs" href="' . base_url('delete/pub/' . $this->idM . '/' . $value->add_title . '/' . $value->add_id . '/confirm') . '">' . $this->config->item('delete') . '</a> | ' .
anchor_popup('admin/view_add/' . $this->idM . '/' . $value->add_id, ' View ', $atts) . '  </td>
</tr>';
}
} else {
echo '<tr>
<td colspan="7">
Vous n\'avez aucune publicité pour l\'instant.
</td>
</tr>';
}
echo '</tbody>
</table>';
break;
//-------------------------------------------- add pub-----------------------------------------
case 'edit pub':
$atts = array(
'width'       => 800,
'height'      => 600,
'scrollbars'  => 'yes',
'status'      => 'yes',
'resizable'   => 'yes',
'screenx'     => 0,
'screeny'     => 0,
'window_name' => '_blank',
'class' => 'btn btn-primary btn-sm col-sm-3'
);
?>
                                <ul class="breadcrumb">
                                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                                    <li class="active"><?= $bread ?></li>
                                </ul>
                                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                                    <table class="table table-responsive table-striped containerbox">
                                        <tr>
                                            <th>Ajouter une publicité </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="color:#F0F0F0 !important;">
                                                    A partir de cette page, vous pouvez ajouter des publicités à votre
                                                    forum. Les pages suceptibes de contenir des pub sont limité vu le
                                                    template des forums qui est totalement différent des pages
                                                    ordinaire du web, ne permet pas d'insérer les pub n'importe comment
                                                    et n'importe ou.<br>
                                                    les pages sur lequelle vous pouver insérer la pub sont listées dans
                                                    le formulaire ci-dessous. Les pub seront injectées selon votre
                                                    choix dans:<br>
                                                    1- le haut de la page.<br>
                                                    2- Au bas de la page.<br>
                                                    Si vous insérer plusieurs pub au m&ecirc;me endroit, les pub seront
                                                    affichées aléatoirement. c'est à dire, à chaque rechargement de la
                                                    page une seule pub (parmis les pub éxistentes) sera affichéé.<br>
                                                    Les bannières seront redimentionnées automatiquent pour les
                                                    appareils mobiles et tablettes.
                                                    Nous avons mis en évidence que les formats standards de bannières.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br><br>
                                <?php
if ($editpub->num_rows() > 0) {
echo form_open('admin/edit_pub/' . $this->idM);
foreach ($editpub->result() as $val) :
if ($val->add_title) {
$title = $val->add_title;
} else {
$title = set_value('title');
}
if ($val->add_format) {
$format = $val->add_format;
} else {
$format = set_value('format');
}
if ($val->add_page) {
$page = $val->add_page;
} else {
$page = set_value('page');
}
if ($val->add_position) {
$position = $val->add_position;
} else {
$position = set_value('position');
}
if ($val->add_code) {
$code = $val->add_code;
} else {
$code = set_value('code');
}
?>
                                <div class="form-group">
                                    <?= form_error('title') ?>
                                    <label for="objet" class="col-sm-3 control-label">Titre de Pub <span
                                            data-html="true" title="Champ obligatoire."
                                            data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="title" id="title" value="<?= $title; ?>"
                                            class="form-control input-sm" id="objet"
                                            placeholder="Donnez un titre à votre bannière de pub">
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <?= form_error('format') ?>
                                    <label class="col-sm-3 control-label" for="format">Format de pub <span
                                            data-html="true" title="Champ obligatoire."
                                            data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control input-sm" name="format" id="format">
                                            <option value="choisir">choisir </option>
                                            <option <?php if ($val->add_format == "88x31") echo 'selected'; ?>
                                                value="88x31">88 x 31 px </option>
                                            <option <?php if ($val->add_format == "120x90") echo 'selected'; ?>
                                                value="120x90">120 x 90 px </option>
                                            <option <?php if ($val->add_format == "234x60") echo 'selected'; ?>
                                                value="234x60">234 x 60 px </option>
                                            <option <?php if ($val->add_format == "320x50") echo 'selected'; ?>
                                                value="320x50">320 x 50 px</option>
                                            <option <?php if ($val->add_format == "468x60") echo 'selected'; ?>
                                                value="468x60">468 x 60 px </option>
                                            <option <?php if ($val->add_format == "728x90") echo 'selected'; ?>
                                                value="728x90">728 x 90 px</option>
                                            <option <?php if ($val->add_format == "970x90") echo 'selected'; ?>
                                                value="970x90">970 x 90 px</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <?= form_error('page') ?>
                                    <label class="col-sm-3 control-label" for="page">Page de destination <span
                                            data-html="true" title="Champ obligatoire."
                                            data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control input-sm" name="page" id="page">
                                            <option value="choisir">choisir </option>
                                            <option <?php if ($val->add_page == "index") echo 'selected'; ?>
                                                value="index">index forum </option>
                                            <option <?php if ($val->add_page == "forum") echo 'selected'; ?>
                                                value="forum">voir forum</option>
                                            <option <?php if ($val->add_page == "topic") echo 'selected'; ?>
                                                value="topic">voir topic</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <?= form_error('position') ?>
                                    <label class="col-sm-3 control-label" for="position">Position <span data-html="true"
                                            title="Champ obligatoire."
                                            data-toggle="tooltip"><?= $this->config->item('required') ?></span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control input-sm" name="position" id="position">
                                            <option value="choisir">choisir </option>
                                            <option <?php if ($val->add_position == "top") echo 'selected'; ?>
                                                value="top">Haut de page</option>
                                            <option <?php if ($val->add_position == "bottom") echo 'selected'; ?>
                                                value="bottom">Bas de page</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <?= form_error('code') ?>
                                    <label for="code" class="col-sm-3 control-label">code Html de Pub <span
                                            data-html="true"
                                            title="Attention:<br>Vous devez &ecirc;tre s&ucirc;r du code html de votre bannière."
                                            data-toggle="tooltip"><?= $this->config->item('fas_info') ?></span></label>
                                    <div class="col-sm-6">
                                        <textarea type="text" name="code" id="code" value=""
                                            class="form-control input-sm"><?= $code; ?></textarea>
                                    </div>
                                </div>
                                <?php
endforeach; ?>
                                <br><br>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> &nbsp;</label>
                                    <div class="col-sm-6"><br>
                                        <input type="submit" value="Envoyer" id="#" name="Envoyer"
                                            class="btn btn-primary btn-sm">
                                        <input type="hidden" value="<?= $val->add_id ?>" name="add_id">
                                        <a class="btn btn-primary btn-sm"
                                            href="<?= base_url('admin/gerer_pub/' . $this->idM) ?>"><?= nbs(3) ?>Annuler<?= nbs(3) ?></a>
                                    </div>
                                </div>
                                <?= form_close() ?>
                                <br><br>
                                <?php
} else {
echo 'Un problème aurait d&ucirc; se passé lors de la recherche de la pub avec les données en question.<br> veuillez ressayer ultérieuremen.';
}
echo br(3);
break;
//-------------------------------------------- gerer bots----------------------------------------------
case 'gerer robots':
$atts = array(
'width'       => 800,
'height'      => 600,
'scrollbars'  => 'yes',
'status'      => 'yes',
'resizable'   => 'yes',
'screenx'     => 0,
'screeny'     => 0,
'window_name' => '_blank',
'class' => 'btn btn-default btn-sm',
'data-html' => "true",
'data-toggle' => "tooltip",
'data-title' => "Cliquez pour se renseigner sur ce robot"
);
?>
                                <ul class="breadcrumb">
                                    <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                                    <li class="active"><?= $bread ?></li>
                                </ul>
                                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                                    <table class="table table-responsive table-striped containerbox">
                                        <tr>
                                            <th>Gerer la liste des mauvais robots </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="color:#F0F0F0 !important;">
                                                    A partir de cette page, vous pouvez consulter la liste des mauvais
                                                    robots (spider, crawler ou search engine), celà veut dire, en
                                                    dehors des visiteurs normaux, il y a aussi des robots (programmes
                                                    informatiques) qui font eux aussi des recherches sur le web. Chaque
                                                    robot est programmé par son développeur pour effectuer une tache
                                                    bien déterminée. Malheuresement, certains robots ne respectent pas
                                                    les consignes et règles des webmasters et sont vraiment très
                                                    nuisibles. La raison pour laquelle le forum fabb a mis en place un
                                                    système de filtrage des mauvais robots, ces robots sont
                                                    automatiquement filtrés, insérés dans la BD et mis en quarantaine
                                                    pour anéantir leures actions.<br>
                                                    Aucune action n'est requie par vos soins, sauf si par accident, un
                                                    robot qui se respecte s'est fait pris par erreur. vous pouvez le
                                                    reactiver.<br>
                                                    Important:: Ne jamais supprimez un robot nuisible de la liste sauf
                                                    si vous &ecirc;tes s&ucirc;r qu'il s'est fait piégé par erreur.
                                                    Renseignez-vous sur le robot en question avant de le supprimer<br>
                                                    Vous pouvez tester ce système pour voir comment il fonctionne en
                                                    live. Après le teste vous serez bloqué et vous ne serez pas en
                                                    mesure d'acceder aux différente pages du forum. <br>
                                                    Pour vous débloquer après le teste, suivez les consignes
                                                    suivantes::<br>
                                                    1- Copier/coller l'adreese
                                                    suivante::<?= nbs(2) . base_url('badbots/safeip/' . $this->idM . '/' . rawurlencode($this->ip)) . nbs(2) ?><br>
                                                    dans la barre d'adresse de votre navigateur et valider. Vous serez
                                                    débloqué automatiquement.<br>
                                                    2- Par mesure de sécurité, copier/coller votre adresse IP ::
                                                    <strong><?= $this->ip ?></strong> <br>
                                                    Gardez-là soignesement dans un <strong>fichier.txt</strong> jusqu'à
                                                    la fin du teste, vous en aurez besoin en cas de problème.<br>
                                                    3- cliquez sur le bouton en face :: <button id="testbot"
                                                        class="btn btn-primary btn-sm">Tester maintenant</button></p>
                                                <p id="testnow" style="color:#F0F0F0 !important;">
                                                    <?php
		echo 'Cliquez sur le bouton rouge pour confirmer et démarrer le teste ::' . nbs(2) . '<a class="btn btn-danger btn-sm" href="' . base_url('badbots/index/' . $this->idM) . '">Tester maintenant</a>' . nbs(2) . ' Actuellement vous n\'&ecirc;tes pas bloqué.';
		?></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <br><br>
                                </div>
                                <table style="font-size:1.2rem"
                                    class="table table-striped table-bordered table-responsive text-center text-secondary">
                                    <thead>
                                        <tr style="color:#6F6F6F;">
                                            <th class="text-center"><small><strong> Ordre </strong></small></th>
                                            <th class="text-center"><small><strong>Adresse ip </strong></small></th>
                                            <th class="text-center"><small><strong>Date visite</strong></small></th>
                                            <th class="text-center"><small><strong>Nom</strong> </small></th>
                                            <th class="text-center"><small><strong>Pays</strong></small></th>
                                            <th class="text-center"><small><strong>&Eacute;tat</strong></small></th>
                                            <th class="text-center"><small><strong>Action</strong></small></th>
                                        </tr>
                                    </thead>
                                    <tbody id="inactif">
                                        <?php
//On lance la boucle
if ($bots->num_rows() > 0) {
foreach ($bots->result() as $value) {
	echo '<tr style="color:#6F6F6F;">
<td>' . htmlspecialchars($value->bot_id) . '</td>
<td>' . htmlspecialchars($value->bot_ip) . '</td>
<td>' . date('m-d-Y', $value->bot_date) . ' </td>
<td>' . htmlspecialchars($value->bot_agent) . '</td>
<td>' . htmlspecialchars($value->bot_country) . '</td>
<td>';
	if ($value->bot_state == 1) {
		echo '<span data-toggle="tooltip" title="Ce robot est considéré comme nuisible. Il a été bloqué
automatiquement." style="color:red">Bloqué</span>';
	} else {
		echo '<span data-toggle="tooltip" title="Suite à vos recommandations, Ce robot est ligitime."
style="color:green">Ligitime</span>';
	}
	echo '</td>
<td>';
	if ($value->bot_state == 1) {
		echo '  <a class="btn btn-default btn-sm" href="' . base_url('admin/unlock_bot/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '"><span data-toggle="tooltip" title="Cliquez pour rendre ce robot ligitime" style="font-size:12px;
color:green;">' . $this->config->item('lock_open') . '</span></a> |';
	} else {
		echo '  <a class="btn btn-default btn-sm" href="' . base_url('admin/lock_bot/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '"><span data-toggle="tooltip" title="Cliquer pour rendre ce robot hors d\'état de nuir." style="font-size:12px; color:red;">' . $this->config->item('lock') . '</span></a> |';
	}
	echo ' <a data-toggle="tooltip" title="Cliquez pour purger ce robot de la liste" class="btn btn-default btn-sm" href="' . base_url('admin/delete_bots/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '">' . $this->config->item('delete') . '</a> |
' .
		anchor_popup('https://who.is/whois-ip/ip-address/' . rawurlencode($value->bot_ip), $this->config->item('infos'), $atts) . '  </td>
</tr>';
}
} else {
echo '
<br><br>
<tr>
<td colspan="7"><p> La liste des mauvais robots est actuellement vide, mais elle ne tardera pas à recevoir les visiteurs nuisibles</p></td>
</tr>';
}
echo '</tbody>
</table>';
?>
                                        <script>
                                        $(document).ready(function() {
                                            $("#testnow").css('display', 'none');
                                            $("#testbot").click(function() {
                                                $("#testnow").toggle({
                                                    duration: 2000,
                                                });
                                            });
                                        });
                                        </script>
                                        <?php
break;
//----------------------------------------------------- infos --------------------------------------
case 'infos':
echo br(4);
?>
                                        <div class="row" style="padding:20px 20px;">
                                            <div class="col">
                                                <?php if (has_alert()) :
		foreach (has_alert() as $type => $message) : ?>
                                                <div class="alert alert-dismissible <?php echo $type; ?>">
                                                    <button type="button" class="close"
                                                        data-dismiss="alert"><span>&times;</span></button>
                                                    <?php echo $message; ?>
                                                </div>
                                                <?php endforeach;
	endif;
	?>
                                            </div>
                                        </div>
                                        <?php
break;
//------------------------------------ default -----------------------------------------------------
default:
?>
                                        <ul class="breadcrumb">
                                            <li><a href="<?= base_url('forum') ?>">Forum</a></li>
                                            <li><a href="<?= base_url('admin/index/' . $this->idM) ?>">Admin</a></li>
                                            <li class="active">Dashbord</li>
                                        </ul>
                                        <?php
echo '<div class="btn-success" style="border-radius:5px; padding:10px 10px;">';
echo '<table style="color:#6c6c6c; font-size:1.2rem;" style="" class="table table-responsive table-striped">
<tr>
<th>Bienvenue chère admin :: ' . $this->pseudo . ' </th>
</tr>';
echo '
<tr>
<td>
<p style="color:#F0F0F0 !important;">Merci d\'avoir choisi <a href="' . base_url() . '"><strong style="color:#F0F0F0;">fabb</strong></a> comme solution pour votre communauté.<br>
A partir de cette page vous pouvez controler tout les aspects de configuration du forum.
Sur la section gauche de cette fenêtre sont listés les différents liens que vous pouvez suivre pour consulter, modifier, ou mettre à jour certaines données du forum.
Pour chaque lien listé à gauche, vous trouverez des explications sur son utilité et son fonctionnement correspondant.
</p>
</td>
</tr>
</table>
</div>';
}
?>
</div>
</div>
</div>