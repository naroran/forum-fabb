<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
<div class="container-fluid">
    <div class="row">
        <br>
        <div class="col-md-3">
            <!-- column1, Vertical Dropdown Menu -->
            <div id="main-menu" class="list-group">
                <a href="<?=base_url('modo/index/' . $this->idM)?>" class="list-group-item active">Dashbord</a>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Catégorie
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu">
                    <a href="<?=base_url('modo/all_cat/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu">Consulter</a>
                    <a href="<?=base_url('modo/select_ord_cat/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu">Changer l'ordre</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-2" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Forums
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-levhel1" id="sub-menu-2">
                    <a href="<?=base_url('modo/all_forum/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-2">
                        Consulter</a>
                    <a href="<?=base_url('modo/move_forum/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-3">
                        Déplacer</a>
                    <a href="<?=base_url('modo/select_ord_forum/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-2">
                        Changer l'ordre</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-3" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Topic
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-3">
                    <a href="<?=base_url('modo/consulter_topic/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-3">
                        Consulter</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-4" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Membres
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-4">
                    <a href="<?=base_url('modo/members_list/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Liste Des membres </a>
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/profil')?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Consulter/Update</a>
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/avatar')?>" class="list-group-item"
                        data-parent="#sub-menu-4">Update Avatar</a>
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/droit')?>" class="list-group-item"
                        data-parent="#sub-menu-4">Droit du Membre</a>
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/bann')?>" class="list-group-item"
                        data-parent="#sub-menu-4">Bannir</a>
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/delete')?>" class="list-group-item"
                        data-parent="#sub-menu-4">Supprimer</a>
                    <a href="<?=base_url('modo/list_bann/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Liste Bannis</a>
                    <a href="<?=base_url('modo/inactif/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-4">
                        Membres inactifs</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-5" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Mots vulgaires
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-5">
                    <a href="<?=base_url('modo/add_badwords/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-5">
                        Ajouter Mot Vulgaire </a>
                    <a href="<?=base_url('modo/badwords/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-5">
                        Gerer Mots Vulgaire </a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-6" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Messageries
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-6">
                    <a href="<?=base_url('modo/select_member/' . $this->idM . '/mail/')?>" class="list-group-item"
                        data-parent="#sub-menu-6">
                        Envoi simple </a>
                    <a href="<?=base_url('modo/abus_report/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-6">
                        Rapport d'abus</a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="#sub-menu-8" class="list-group-item active" data-toggle="collapse"
                    data-parent="#main-menu">Robots
                    <span style=" float:right;" class="caret"></span></a>
                <div class="collapse list-group-level1" id="sub-menu-8">
                    <a href="<?=base_url('modo/gerer_robots/' . $this->idM)?>" class="list-group-item"
                        data-parent="#sub-menu-8">
                        Gerer Robots </a>
                </div>
                <div style="height:2px; width:auto; color:#B8B350;"></div>
                <a href="<?=base_url('modo/statistic/' . $this->idM)?>" class="list-group-item active">Statistic </a>
            </div>
        </div>
        <div class="col-md-9">
            <?php
switch ($render) {
    case 'all_cat':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li><a>catégories</a></li>
                <li><a>Consulter</a></li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem" class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Liste Des Catégories </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">Dans cette page, Vous trouverez toutes les catégories
                                disponibles dans le forum.</p>
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
            foreach ($list_cat->result() as $cat):
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $cat->cat_name . '</td>
		     <td>' . $cat->cat_order . '</td>
	         </tr>';
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
		  <td colspan="2">Le forum ne contient aucune categorie pour l\'instant.<br>
		  Veuillez ajouter des categories à votre forum svp ....!  </td>
		  </tr>
		  </table>';
        }
        break;
    case 'select ord cat':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li><a>catégories</a></li>
                <li><a>Changer l'ordre</a> </li>
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
                                Toute fois, éviter de donner le meme ordre pour 2 catégories différentes,
                                celà peut engendrer des erreurs dans la base de donnée.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo form_open('modo/edit_ord_cat/' . $this->idM, 'class="form-horizontal"');
        foreach ($query->result_array() as $val):
            echo '<div class="form-group">
		<label class="control-label col-sm-3" for="' . $val['cat_name'] . '">' . $val['cat_name'] . '
		</label>';
            echo '<div class="col-sm-3">
	    <input class="form-control input-sm" id="' . $val['cat_name'] . '"  type="text" value="' . $val['cat_order'] . '"
		name="' . $val['cat_id'] . '" >
		</div></div>';
        endforeach;
        echo '
	<div class="form-group">
	<label class="control-label col-sm-3" for="submit" id="submit"></label>
	 <div class="col-sm-9">
	<input class="btn btn-success btn-sm" id="submit" name="submit" type="submit" value="Envoyer" />
	</div></div>';
        echo form_close();
        break;
    case 'all_forum':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li><a>Forums</a></li>
                <li><a>Consulter</a> </li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem;" class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>Consulter la liste des Forums </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver consulter la liste de tous les forums présents dans la base
                                de donnée.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
if ($forums->num_rows() > 0) {
            echo '<table style="font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
    <tr>
    <th>ordre</th>
	<th>Forum</th>
	<th>Nbr topic</th>
	</tr>';
            $i = 1;
            foreach ($forums->result() as $val):
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $val->forum_name . '</td>';
                echo '<td>' . $val->forum_topic . '</td>';
                echo '</tr>';
                $i++;
            endforeach;
            echo '</table>';
        } else {
            echo '<table style="font-size:1.2rem;" class="table table-striped table-bordered table-responsive">
		 <tr>
		 <th>ordre</th>
		 <th>categorie</th>
		 <th>Nbre Forum</th>
		 </tr>';
            echo '<tr>
		 <td colspan="3" style="padding:20px;">Le forum pour l\'instant est vide.<br>
	     Veuillez crer des catégories ensuite ajoutez les forums svp ....!  </td>
		 </tr>
		 </table>';
        }
        break;
    case 'move forum':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li><a>Forums</a></li>
                <li><a>Déplacer un forum</a> </li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem;" class="table table-responsive table-striped">
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
        echo form_open('modo/move_forum/' . $this->idM, 'class="form-horizontal"');
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
			<a class="btn btn-primary btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Annuler</a>
			</div></div>';
        echo form_close();
        break;
    case 'select ord forum':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Forum</li>
                <li><a>Ordre forum</a></li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem;" class="table table-responsive table-striped">
                    <tr>
                        <th>Ordre des forums </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                A partir de cette page, vous pouver changer l'ordre des forums.<br>
                                Toute fois, éviter de donner le m&ecirc;me ordre pour 2 forums différents,
                                celà peut engendrer des erreurs dans la base de donnée.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
        echo '<table style=" font-size:1.2rem;color:#6C6C6C;" class="table table-striped table-bordered table-responsive">
			<tr>
			<th colspan="2"> Changer l\'ordre des forums </th>
			</tr>
			<tr>
			<td>Catégorie/Forum</td>
			<td>Ordre</td>
			</tr>';
        echo form_open('modo/edit_ord_forum/' . $this->idM);
        foreach ($query->result() as $data):
            if ($categorie !== $data->cat_id) {
                $categorie = $data->cat_id;
                echo '<tr>
		            <td colspan="2">' . $data->cat_name . '</strong></td>
					</tr>';
            }
            echo '<tr>
			<td>
			<a href="' . base_url('voir/forum/' . $data->forum_id) . '">' . $data->forum_name . '</a></td>
			<div class="col-sm-3">
			<div class="form-group">
			<td><input class="form-control input-sm" type="text" value="' . $data->forum_order . '" name="' . $data->forum_id . '" />
			</div></div></td>
			</tr>';
        endforeach;
        echo '
				</div>
				</table>';
        echo '
                <input class="btn btn-success btn-sm" type="submit" value="Envoyer">';
        echo form_close();
        echo br(2);
        break;
    case 'consulter topic':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Topic</li>
                <li><a>All topic</a></li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem;" class="table table-responsive table-striped">
                    <tr>
                        <th>Consulter les topic </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                Dans cette page, vous pouver consulter tous les topic du forum.<br>
                                En plus de la consultation, vous pouvez éditer, supprimer, verrouiller, dévérrouiller et
                                ajouter <br>
                                des nouveaux topic à la liste éxistante en cliquant sur l'icone correspondante.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo $link;
        echo '<table style="font-size:1.2rem;" class="table table-striped table-responsive">
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
            foreach ($query->result() as $val):
                echo '<tr>
			<td>' . $val->topic_id . '</td>
			<td>' . $val->forum_name . '</td>
		    <td><a data-toggle="tooltip" title="Allez voir ce topic" href="' . base_url('voir/topic/' . $val->topic_id) . '">' . $this->bbcode->netcode($val->topic_title) . '</a></td>
		    <td>' . $this->bbcode->netcode($val->topic_post) . '</td>
		    <td><img class="img-thumbnail" src="' . thumb(base_url('assets/avatars/' . $val->member_avatar), 30, 30) . '" alt="pas d avatar" />
		   <a data-toggle="tooltip" title="voir le profil de ' . $val->member_pseudo . '...!" href="' . base_url('member/visit_profil/' . $this->idM . '/' . $val->member_id) . '">' . $val->member_pseudo . '  </a></td>
		    <td><span style="font-size:10px">' . date('\L\e d M Y \à H\hi', $val->topic_time) . '</span><br /></td>
		    <td> <a data-toggle="tooltip" title="Editez ce topic " href="' . base_url('modo/edit_topic/' . $this->idM . '/' . $val->topic_id) . '">' . $this->config->item('edit') . '</a> |
			 <a data-toggle="tooltip" title="Supprimez ce topic "  href="' . base_url('modo/delete_topic/' . $this->idM . '/' . $val->topic_id) . '">' . $this->config->item('delete') . '</a> | ';
                if ($val->topic_locked == 1) {
                    echo '<a  data-toggle="tooltip" title="déverouiller ce topic " href="' . base_url('unlock/topic/' . $val->topic_id) . '"><span style="color:red">' . $this->config->item('lock') . '</span></a>';
                } else {
                    echo ' <a data-toggle="tooltip" title="verouiller ce topic " href="' . base_url('lock/topic/' . $val->topic_id) . '"> <span style="font-size:12px; color:green;"><i class="fas fa-lock-open"></i></span></a> ';
                }
                echo ' | <a data-toggle="tooltip" title="Ajouter un topic au forum: ' . $val->forum_name . '" href="' . base_url('poster/add_topic/' . $val->topic_forum_id) . '"><span style="font-size:12px; color:blue;"><i class="fas fa-plus"></i></span></a>';
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
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Topic</li>
                <li><a>&Eacute;dition topic</a></li>
            </ul>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table class="table table-responsive table-striped containerbox">
                    <tr>
                        <th>&Eacute;dition de topic: <span style="color:red"><strong><?=$titre_topic?></strong></span>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <p style="color:#F0F0F0 !important;">
                                &Aacute; partir de cette page, vous pouvez éditer le topic choisi:
                                <strong><?=$titre_topic?></strong> . <br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
        echo '
			<p><strong> Information sur le topic </strong></p>';
        echo '<table style="font-size:1.2rem;" class="table table-striped table-responsive">
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
        echo '<table style="font-size:1.2rem;" class="table table-striped table-responsive">
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
        $action = base_url('modo/edited_topic/' . $this->idM . '/' . $topic);
        $attributs = array(
            'id' => 'myform',
            'name' => 'myform');
        $this->load->add_package_path(APPPATH . 'third_party/resources', false);
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
                <textarea class="form-control" style="width:60%; height:30vh;" id="message" name="message"><?php if ($this->input->post('message')) {
            echo htmlspecialchars($this->input->post('message'));
        } else {
            echo htmlspecialchars($post_text);
        }
        ?> </textarea>
            </div>
            <input type="hidden" name="post_id" value="<?=$post_id?>" />
            <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Envoyer" />
            <input class="btn btn-primary btn-sm" type="reset" name="Effacer" value="Effacer" />
            <input type="submit" class="btn btn-default btn-sm" id="preview" name="preview" value="Preview" />
            <?php
echo form_close();
        ?>
            <fieldset>
                <div id="loading"><img src="<?=base_url('assets/img/loader.gif')?>"></div>
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
                        url: '<?=base_url("ajaxcall/new_pm")?>',
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
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                <li><a>liste Membres</a></li>
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
                                    Recherche:</strong> Dans le champ Nbr de lignes, choisissez le nombre le plus proche
                                à celui de votre liste.<br>
                                Ensuite dans le champ "recherche rapide", en introduisant les premières lettre du pseudo
                                du membre à rechercher, les résultats s'auto-eliminent pour n'afficher que le membre
                                dont le pseudo concorde à votre recherche.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <?php
echo $link;
        echo form_open('modo/members_list/' . $this->idM, 'class="form-inline"');
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
        if ($resp->row() != null) {
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
                } else {echo '<td>' . $this->config->item('wifi_on') . '</td>
           </tr>';
                }
            }
            ?>
                </tbody>
            </table>
            <?php
} else
        {
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
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                <li><a>Select Membres</a></li>
            </ul>
            <hr>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="font-size:1.2rem; color:rgb(255,255,255);" class="table table-responsive table-striped">
                    <tr>
                        <th style="color: #787878;">
                            <?php
if (($form_action === 'modo/update_avatar/' . $this->idM) || $this->uri->segment(4) == 'avatar') {
            echo 'Editer l\'avatar d\'un membre';
        } elseif ($form_action === 'modo/droit_member/' . $this->idM || $this->uri->segment(4) == 'droit') {
            echo 'Editer les droits d\'un membre';
        } elseif ($form_action === 'modo/bann_member/' . $this->idM || $this->uri->segment(4) == 'bann') {
            echo 'Bannir un membre';
        } elseif ($form_action === 'modo/simple_mail/' . $this->idM || $this->uri->segment(4) == 'mail') {
            echo 'Email simple';
        } elseif ($form_action === 'modo/delete_member/' . $this->idM || $this->uri->segment(4) == 'delete') {
            echo 'Supprimer un compte';
        } else {
            echo 'Editer le profil d\'un membre';
        }
        ?> </th>
                    </tr>
                    <tr>
                        <td>
                            <?php
if ($form_action === 'modo/update_avatar/' . $this->idM || $this->uri->segment(4) == 'avatar') {
            echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez consulter et éditer l\'avatar d\'un membre. <br>Veuillez introduire le pseudo du membre.</p>';
        } elseif ($form_action === 'modo/droit_member/' . $this->idM || $this->uri->segment(4) == 'droit') {
            echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez éditer les droits d\'un membre. <br>Veuillez introduire le pseudo du membre.</p>';
        } elseif ($form_action === 'modo/bann_member/' . $this->idM || $this->uri->segment(4) == 'bann') {
            echo '<p style="color:#F0F0F0 !important;"> A partir de cette fen&ecirc;tre vous pouvez bannir des membres du forum. <br>Veuillez introduire le pseudo du membre que vous voulez bannir.</p>';
        } elseif ($form_action === 'modo/simple_mail/' . $this->idM || $this->uri->segment(4) == 'mail') {
            echo '<p style="color:#F0F0F0 !important;"> Cette page vous permet d\'envoyer des messages à vos
		  membres.<br>
		  <br>Veuillez introduire le pseudo du membre que vous voulez lui envoyer le message.</p>';
        } elseif ($form_action === 'modo/delete_member/' . $this->idM) {
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
        }?>
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
                <input class="form-control input-sm member" value="<?=set_value('membre')?>" type="text" id="membre"
                    name="membre">
                <br>
                <input class="btn btn-primary btn-sm" name="submit" type="submit" value="Valider"> |
                <input class="btn btn-primary btn-sm" type="reset" value="Effacer"> |
                <a class="btn btn-primary btn-sm" href="<?=base_url('modo/index/' . $this->idM)?>">Annuler</a>
            </div>
            <?php echo form_close();
        break;
    case 'profil member':
        ?>
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                <li><a>Profil Membre</a></li>
            </ul>
            <?php
echo form_open_multipart('modo/update_member/' . $this->idM, 'class="form-horizontal"');
        foreach ($query->result() as $value):
        ?>
            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                <table style="color:#F0F0F0 !important;font-size:1.2rem" class="table table-responsive table-striped">
                    <tr>
                        <th style="color:#7D7D7D;">
                            Consulter/Editer le profil de: <?=htmlspecialchars($value->member_pseudo)?>.
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <p style="color:#F0F0F0 !important; font-size:1.3rem !important;">
                                La présente page vous permet de consulter / éditer le profil de
                                <?=htmlspecialchars($value->member_pseudo)?>. <br>certaine données sont propres au
                                membre,
                                par conséquence vous ne pouvez pas les changer. D'autres ne les sont pas.
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
		<a class="btn btn-primary btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Admin </a>
		</div> ';
        endforeach;
        echo form_close();
        echo '<br><br>';
        break;
    case 'update avatar':
        $id = isset($id) ? $id : $this->uri->segment(4);
        $pseudo = isset($pseudo) ? $pseudo : '';
        $avatar = isset($avatar) ? $avatar : '';
        ?>
                <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Avatar</li>
                    <li class="active">Update</li>
                </ul>
                <hr>
                <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                    <table style="font-size:1.2rem !important"
                        class="table table-responsive table-striped containerbox">
                        <tr>
                            <th>Changer l'avatar du membre: <?=$pseudo?></th>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:#F0F0F0 !important;">
                                    A partir de cette page, vous pouver changer l'avatar du membre si l'avatar de
                                    celui-ci
                                    est offensif ou inapproprié.<br>
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
        echo form_open_multipart('modo/update_avatar/' . $this->idM);
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
                    <p><label>L'avatar actuel du membre <?=$pseudo . nbs(4)?> <img
                                src="<?=thumb(base_url('assets/avatars/' . $avatar), 40, 40)?>" alt="avatar membre"></p>
                    <div class="form-group">
                        <input class="form-control input-sm" type="file" name="avatar" onchange="readURL(this);"
                            id="avatar" />
                    </div>
                    <img id="preview" src="#" alt="En attente de selection d'avatar" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="pseudo" value="<?=$pseudo?>" />
                    <input type="hidden" name="avatar" value="<?=$avatar?>" />
                    <input class="btn btn-success btn-sm" name="modifier" type="submit" value="Modifier"> | <a
                        class="btn btn-success btn-sm" href="<?=base_url('modo/index/' . $this->idM);?>">Retour
                        Admin</a>
                </div>
                <?php
echo form_close();
        break;
    case 'droit member':
        ?>
                <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                    <li class="active">Droit Membre </li>
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
                                    un
                                    membre ou un simple visiteur.<br>
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
                6 => "Administrateur");
            echo form_open('modo/droit_member/' . $this->idM);
            foreach ($query->result_array() as $data):
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
                if (isset($error)) {echo '<span style="color:red">' . $error . '</span>';
                } else {echo
                        $statu;}
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
        echo '</div>
									<div>';
        if (isset($member)) {
            echo '<input type="hidden" value="' . stripslashes($member) . '" name="member"> ';
        } elseif (isset($data['member_pseudo'])) {
            echo '<input type="hidden" value="' . stripslashes($data['member_pseudo']) . '" name="member"> ';
        }
        echo '<input class="btn btn-primary btn-sm" type="submit" name="envoyer" value="Envoyer"> |
		<a class="btn btn-primary btn-sm" href="' . base_url('modo/indes' . $this->idM) . '">Annuler</a>
		</div>';
        echo form_close();
        echo br(2);
        break;
    case 'list bann':
        ?>
                <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Bannissement</li>
                    <li class="active">Membres <?=$bread?></li>
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
                <?=form_open('modo/debann/' . $this->idM);?>
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
            echo '<input class="btn btn-primary btn-xs"  data-toggle="tooltip" title="il n\'y a aucun membre à débannir." name="submit" disabled type="submit" value="Débannir" >';}?>
                                    </strong></small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $val):
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
						<a href="' . base_url('modo/select_member/' . $this->idM . '/bann') . '" class="btn btn-primary btn-xs">Bannir
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
    case 'inactifs':
        ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                            <li class="active">Membres <?=$bread?></li>
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
                                            configuration.
                                            <br>
                                            Important ::<br>
                                            La configuration de la période d'inavtivité est exprimée en mois.<br>
                                            Exemple:<br>
                                            1 mois = 1<br>
                                            6 mois = 6<br>
                                            1 an = 12<br>
                                            2 ans = 24<br>
                                            illimité = 0, la période d'inactivité doit &ecirc;tre un chiffre entier.<br>
                                            <hr>
                                            <p style="color:#F0F0F0 !important;">
                                                Dans cette page, les options disponibles sont:<br>
                                                Aviser: envoyer un méssage interne au membre inactif, s'il se connecte
                                                entre
                                                temps, il s'aura le méssage et de cette manière vous encouragez les
                                                membres
                                                à contribuer sur votre forum au lieu de les supprimer.<br>
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
                echo '<td>' . $state . '</td>
		   ';
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
} else
        {
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
    case 'add bad':
        ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Mot vulgaire</li>
                            <li class="active">Ajouter</li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table style="font-size:1.2rem;" class="table table-responsive table-striped">
                                <tr>
                                    <th>Ajout de mot vulgaire </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            A partir de cette page, vous pouvez ajouter des mots vulgaires à votre liste
                                            des
                                            mots sensurés. Le mot vulgaire est sensuré par un masque que vous désignez
                                            vous
                                            m&ecirc;me et par n'importe quel caractèea. Vous pouvez remplacer le mot
                                            sensuré
                                            aussi carément par un autre mot. Par exemple:[mot sensuré] </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
        echo form_open('modo/add_badwords/' . $this->idM);
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
    case 'bad words':
        ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Mot vulgaire</li>
                            <li class="active">Gérer</li>
                        </ul>
                        <?php
echo '<hr>
	   <table style="font-size:1.2rem" class="table table-striped table-responsive">
       <tr>
       <th>Gestion des mots vulgaires</th>
       </tr>
	   </table>';
        echo $link;
        echo form_open('modo/badwords/' . $this->idM, 'class="form-inline"');
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
        echo form_open('modo/badwords/' . $this->idM);
        echo '<input class="form-control" id="mybad" type="text" placeholder="Recherche rapide ...">';
        echo '<table style="font-size:1.3rem" class="table table-striped table-bordered table-responsive">
	 <thead>
       <tr>
       <th>id</th>
       <th>badword</th>
       <th>remplacemen</th>
       <th ><span class="btn btn-primary btn-xs"><input data-toggle="tooltip" title="Attendez que la page soit complètement chargée ensuite chochez ce petit carré blan" type="checkbox" id="checkAll">' . nbs(2) . ' Tout selectionner</span></th>
       <th ><p style="text-align:right;"><input class="btn btn-primary btn-xs" type="submit" value="Tout supprimer"></th>
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
	   		  <p style="text-align:right;"> <input class="btn btn-primary btn-xs"  type="submit" value="Tout Supprimer"></p>
	   </td>
	   </tr>';
        } else
        {
            echo '
		<tr>
	   <td colspan="5"> Vous n\'avez pas encore defini des mots vulgaire. </td>
	   </tr>';
        }
        echo '</tbody></table>';
        echo form_close();
        echo $link;
        ?>
                        <script>
                        $("#checkAll").change(function() {
                            $(".checkbox").prop('checked', $(this).prop("checked"));
                        });
                        $('.checkbox').change(function() {
                            if (false == $(this).prop("checked")) {
                                $("#checkAll").prop('checked', false);
                            }
                            if ($('.checkbox:checked').length == $('.checkbox').length) {
                                $("#checkAll").prop('checked', true);
                            }
                        })
                        </script>
                        <?php
        break;
    case 'mail member':
        if (isset($active)) {
            $conn = $active;
        } else { $conn = 'sendMail';}
        ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Membre</li>
                            <li class="active">Envoi email</li>
                        </ul>
                        <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                            <table style="font-size:1.2rem;" class="table table-responsive table-striped containerbox">
                                <tr>
                                    <th>Envoyer un message </th>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#F0F0F0 !important;">
                                            Cette page vous permet d'envoyer des messages à vos membres. Seulement, il
                                            faut
                                            savoir que vous ne pouvez pas envoyer plus d'un message.<br>
                                            Si vous voulez envoyer des messages en masse veuillez contacter votre
                                            administrateur.
                                            <hr>
                                            <p style="color:#F0F0F0 !important;">La connexion smtp actuellement utilisée
                                                est
                                                :: <strong><?=$conn?></strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6">
                                <p class="input-sm">Pseudo Du Destinataire : <?=$membre_pseudo?></p>
                            </div>
                        </div>
                        <?=form_open('modo/mail_member/' . $this->idM, 'class="form-horizontal"');?>
                        <div class="form-group">
                            <label for="to" class="col-sm-1 control-label">To:</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control input-sm" name="to" value="<?=$membre_email?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from" class="col-sm-1 control-label">From:</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control input-sm" name="from"
                                    value="<?=$this->config_model->admin_contact()?>" readonly>
                            </div>
                        </div>
                        <br>
                        <br>
                        <?=form_error('objet');?>
                        <div class="form-group">
                            <label for="objet" class="col-sm-1 control-label">Objet:</label>
                            <div class="col-sm-6">
                                <input type="text" name="objet" value="<?=set_value('objet');?>"
                                    class="form-control input-sm" id="objet" placeholder="Objet du message">
                            </div>
                        </div>
                        <?=form_error('message');?>
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
                                <input type="hidden" name="member_email" value="<?=$membre_email?>">
                                <input type="hidden" name="member_pseudo" value="<?=$membre_pseudo?>">
                                <input type="submit" class="btn btn-primary btn-sm" name="submit_mail" value="Envoyer">
                                <input type="reset" class="btn btn-primary btn-sm" value="Effacer">
                                <a href="<?=base_url('modo/' . $this->idM)?>" class="btn btn-primary btn-sm">Retour
                                    Modo</a>
                            </div>
                        </div>
                        <?php
echo form_close();
        break;
    case 'abus':
        ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Abus</li>
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
                                            Dans cette page vous recevez les messages des membres qui vous ont envoyé
                                            des
                                            rapports concernants leurs<br>
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
        </tr>
		';
            foreach ($query->result() as $data):
                {
                    echo '<tr>';
                    if ($data->contact_read == 0) {
                        echo '<td><img src="' . base_url('assets/img/msg_non_lu.png') . '" alt="Non lu" /></td>';
                    } else
                {
                        echo '<td>
				<img src="' . base_url('assets/img/msg_deja_lu.png') . '" alt="Déja lu" /></td>';
                    }
                    echo '<td>';
                    echo '<p><a data-toggle="tooltip" title="Cliquez pour lire le méssage envoyé par ' . htmlspecialchars($data->member_pseudo) . '" href="' . base_url('modo/read_abus/' . $this->idM . '/' . $data->contact_id) . '">
	            ' . htmlspecialchars($data->contact_object) . '</a></p></td>
	            <td id="mp_expediteur">
	            <a href="' . base_url('visit/profil/' . $this->idM . '/' . $data->contact_idm) . '">
	            ' . htmlspecialchars($data->member_pseudo) . '</a></td>
	            <td id="mp_time">' . date('\l\e d M Y \à  H:i:s', $data->contact_date) . '</td>';
                    if (!empty($data->online_id)) {
                        echo '<td>' . $this->config->item('wifi_on') . '</td>';
                    } else {
                        echo '<td>' . $this->config->item('wifi_off') . '</td>';
                    }
                    echo '<td>';
                    echo '<a data-toggle="tooltip" title="Cliquez pour supprimer ce méssage" href="' . base_url('delete/report/' . $this->idM . '/' . $data->contact_id . '/msg') . '">' . $this->config->item('delete') . '</a>
				</td></tr>';
                }
            endforeach;
            echo '</table>';
        }
        else {
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
	        <p class="text-center"><a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Retour M-Panel</a></p></td>
				</tr>
	        </table>';
            }
            break;
        case 'read abus':
            ?>
                        <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Abus</li>
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
    foreach ($query->result() as $data):
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
        case 'gerer robots':
            $atts = array(
                'width' => 800,
                'height' => 600,
                'scrollbars' => 'yes',
                'status' => 'yes',
                'resizable' => 'yes',
                'screenx' => 0,
                'screeny' => 0,
                'window_name' => '_blank',
                'class' => 'btn btn-default btn-sm',
                'data-html' => "true",
                'data-toggle' => "tooltip",
                'data-title' => "Cliquez pour se renseigner sur ce robot");
            ?>
                                    <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Bots</li>
                <li class="active"><?=$bread?></li>
                </ul>
                                    <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                                        <table class="table table-responsive table-striped containerbox">
                                            <tr>
                                                <th>Gerer la liste des mauvais robots </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="color:#F0F0F0 !important;">
                                                        A partir de cette page, vous pouvez consulter la liste des
                                                        mauvais
                                                        robots (spider, crawler ou search engine), celà veut dire, en
                                                        dehors
                                                        des visiteurs normaux, il y a aussi des robots (programmes
                                                        informatiques) qui font eux aussi des recherches sur le web.
                                                        Chaque
                                                        robot est programmé par son développeur pour effectuer une tache
                                                        bien déterminée. Malheuresement, certains robots ne respectent
                                                        pas
                                                        les consignes et règles des webmasters et sont vraiment très
                                                        nuisibles. La raison pour laquelle le forum fabb a mis en place
                                                        un
                                                        système de filtrage des mauvais robots, ces robots sont
                                                        automatiquement filtrés, insérés dans la BD et mis en
                                                        quarantaine
                                                        pour anéantir leures actions.<br>
                                                        Aucune action n'est requie par vos soins, sauf si par accident,
                                                        un
                                                        robot qui se respecte s'est fait pris par erreur. vous pouvez le
                                                        réactiver.<br>
                                                        Important:: Ne jamais supprimez un robot nuisible de la liste
                                                        sauf
                                                        si vous &ecirc;tes s&ucirc;r qu'il s'est fait piégé par erreur.
                                                        Renseignez-vous sur le robot en question avant de le
                                                        supprimer<br>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br><br>
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
                        echo '  <a class="btn btn-default btn-sm" href="' . base_url('modo/unlock_bot/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '"><span data-toggle="tooltip" title="Cliquez pour rendre ce robot ligitime" style="font-size:12px;
				 color:green;">' . $this->config->item('lock_open') . '</span></a> |';
                    } else {
                        echo '  <a class="btn btn-default btn-sm" href="' . base_url('modo/lock_bot/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '"><span data-toggle="tooltip" title="Cliquer pour rendre ce robot hors d\'état de nuir." style="font-size:12px; color:red;">' . $this->config->item('lock') . '</span></a> |';
                    }
                    echo ' <a data-toggle="tooltip" title="Cliquez pour purger ce robot de la liste" class="btn btn-default btn-sm" href="' . base_url('modo/delete_bots/' . $this->idM . '/' . $value->bot_id . '/' . rawurlencode($value->bot_ip)) . '">' . $this->config->item('delete') . '</a> |'.anchor_popup('https://who.is/whois-ip/ip-address/' . rawurlencode($value->bot_ip), $this->config->item('infos'), $atts) . '  </td>
	           </tr>';
                }
            } else {
                echo '
			   <br><br>
			   <tr>
			   <td colspan="7"><p> La liste des mauvais robots est actuellement vide, mais elle ne tardera pas à recevoir très prochainement les visiteurs nuisibles</p></td>
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
        case 'statistic':
            ?>
                                            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li>Statistiques</li>
                 <li class="active">consulter</li>
              </ul>
                                            <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
                                                <table style="font-size:1.2rem;"
                                                    class="table table-responsive table-striped containerbox">
                                                    <tr>
                                                        <th>Résumé de statistique du forum</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p style="color:#F0F0F0 !important;">
                                                                Dans cette page vous trouverez quelques statistiques du
                                                                forum<br>
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
				  </tr>
	';
                foreach ($list_forum->result() as $row):
                    echo '<tr>';
                    echo '<td>' . $j . '</td>';
                    echo '<td>' . htmlspecialchars($row->forum_name) . '</td>';
                    echo '<td>' . htmlspecialchars($row->forum_topic) . '</td>';
                    echo '<td>' . htmlspecialchars($row->forum_post) . '</td>';
                    echo '</tr>';
                    $j++;
                endforeach;
                echo '</table>';
            }
            if ($totalMembers == 1) {
                $total = 'membre';
            } else { $total = 'membres';}
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
		   </tr>
		   </table>';
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
		   </tr>
		   <tr>
	       <td style="text-align:center !important;">' . $online->num_rows() . '</td>
	       <td style="text-align:center !important;">' . $day . '</td>
	       <td style="text-align:center !important;">' . $week . '</strong></td>
	       <td style="text-align:center !important;">' . $month . '</td>
	       <td style="text-align:center !important;">' . $year . '</td>
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
                foreach ($data_online->result() as $val):
                    echo '<tr>
		       <td>';
                    if ($this->ip == $val->online_ip) {echo '<strong style="color:red;">Votre IP :: </strong>' . $val->online_ip;
                    } else {echo $val->online_ip;}
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
                foreach ($data_day->result() as $val):
                    echo '<tr>
		       <td>';
                    if ($this->ip == $val->online_ip) {echo '<strong style="color:red;">Votre IP :: </strong>' . $val->online_ip;
                    } else {echo $val->online_ip;}
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
        default:
            ?>
                <ul class="breadcrumb">
                <li><a href="<?=base_url('forum')?>">Forum</a></li>
                <li><a href="<?=base_url('modo/index/' . $this->idM)?>">Modo</a></li>
                <li class="active">Dashbord</li>
                </ul>
                                            <?php
    echo '<div class="btn-success" style="border-radius:5px; padding:10px 10px;">';
            echo '<table style="color:#6c6c6c; font-size:1.2rem;" style="" class="table table-responsive table-striped">
			  <tr>
			  <th>Bienvenue chère modérateur :: ' . $this->pseudo . ' </th>
			  </tr>';
            echo '
			  <tr>
			  <td>
			  <p style="color:#F0F0F0 !important;">Merci d\'avoir choisi <a href="' . base_url() . '"><strong style="color:#F0F0F0;">fabb</strong></a> comme solution pour votre communauté.<br>
			  A partir de cette page vous pouvez controler tout les aspects de configuration du forum. &Agrave; savoir certaines options ne sont pas disponibles dans les pages de la modération. Les dites options sont intégrées dans les pages de l\'administrateur.<br>
	Si vous bloquez devant une modération, veuillez vous rapprocher auprès de votre administrateur.<br>
			   Sur la section gauche de cette fenêtre sont listés les différents liens que vous pouvez suivre pour consulter, modifier, ou mettre à jour certaines données du forum.
			    Pour chaque lien listé à gauche, vous trouverez des explications sur son utilité et son fonctionnement correspondant dans la page en question.
				</p>
			  </td>
			  </tr>
			  </table>
			  </div>';
            break;
        case 'undo ban member':
            echo $reussi;
            break;
            break;
        case 'mail members':
            ?>
                                            <ul class="breadcrumb">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Forum</a></li>
                                                <li><a href="#">Admin</a></li>
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
                                                                Cette page vous permet d'envoyer des messages à vos
                                                                membres
                                                                en fonction de la liste que vous avez sélectionné
                                                                précédement.<br>
                                                                <p style="color:red !important;">Important ::</p>
                                                                <p style="color:#F0F0F0 !important;">Si votre liste des
                                                                    adresse email est longue, cette opération peut
                                                                    prendre
                                                                    un certain temps.</p>
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
                                            <?=form_open('admin/masse_mail/' . $this->idM, 'class="form-horizontal"');?>
                                            <div class="form-group">
                                                <label for="to" class="col-sm-3 control-label text-danger">To ::<span
                                                        data-toggle="tooltip"
                                                        title="Vous pouvez ajouter d'autres emails, ils doivent &ecirc;tre séparés par une
	                        virgule (,) sauf après le dernier email la virgule est facultatif."><?=nbs(2) . $this->config->item('fas_info')?></span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" readonly class="form-control input-sm" name="to"
                                                        value="<?php
    foreach ($to as $contact) {
                echo $contact . ',';
            }
            ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="from" class="col-sm-3 control-label text-danger"><span
                                                        data-toggle="tooltip" title="Obligatoire.">From ::
                                                    </span></label>
                                                <div class="col-sm-6">
                                                    <input type="email" class="form-control input-sm" name="from"
                                                        value="<?=$this->config_model->admin_contact()?>" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <?=form_error('objet');?>
                                            <div class="form-group">
                                                <label for="objet" class="col-sm-3 control-label text-danger"><span
                                                        data-toggle="tooltip" title="Obligatoire.">Objet ::</span>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="objet" value="<?=set_value('objet');?>"
                                                        class="form-control input-sm" id="objet"
                                                        placeholder="Objet du message est obligatoire">
                                                </div>
                                            </div>
                                            <?=form_error('message');?>
                                            <div class="form-group">
                                                <label for="message" class="col-sm-3 control-label text-danger"><span
                                                        data-toggle="tooltip" title="Obligatoire.">Message
                                                        ::</span></label>
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
                                                    <input type="submit" class="btn btn-primary btn-sm"
                                                        name="masse_mails" value="Envoyer">
                                                    <input type="reset" class="btn btn-primary btn-sm" value="Effacer">
                                                </div>
                                            </div>
                                            <?php
    echo form_close();
            break;
        case 'infos':
            echo br(4);
            ?>
                                            <div class="row" style="padding:20px 20px;">
                                                <div class="col">
                                                    <?php if (has_alert()):
                foreach (has_alert() as $type => $message): ?>
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
}
?>
        </div>
    </div>
</div>