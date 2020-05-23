--
-- Structure de la table `fabb_adds`
--

CREATE TABLE IF NOT EXISTS `fabb_adds` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `add_page` varchar(16) NOT NULL,
  `add_position` varchar(8) NOT NULL,
  `add_title` varchar(64) NOT NULL,
  `add_date` int(11) NOT NULL,
  `add_format` varchar(11) NOT NULL,
  `add_code` text NOT NULL,
  `add_stat` enum('1','0') NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=MyISAM;

--
-- Structure de la table `fabb_badwords`
--

CREATE TABLE IF NOT EXISTS `fabb_badwords` (
  `badword_id` int(11) NOT NULL AUTO_INCREMENT,
  `badword_word` varchar(255) NOT NULL,
  `badword_replace` varchar(255) NOT NULL,
  PRIMARY KEY (`badword_id`),
  KEY `badword_word` (`badword_word`)
) ENGINE=InnoDB;

--
-- Structure de la table `fabb_bots`
--

CREATE TABLE IF NOT EXISTS `fabb_bots` (
  `bot_id` int(11) NOT NULL AUTO_INCREMENT,
  `bot_ip` varchar(32) NOT NULL,
  `bot_date` int(32) NOT NULL,
  `bot_agent` text NOT NULL,
  `bot_country` varchar(128) NOT NULL,
  `bot_code` varchar(4) NOT NULL,
  `bot_city` varchar(32) NOT NULL,
  `bot_platform` varchar(128) NOT NULL,
  `bot_state` enum('1','0') NOT NULL,
  PRIMARY KEY (`bot_id`)
) ENGINE=MyISAM;

--
-- Structure de la table `fabb_cat`
--

CREATE TABLE IF NOT EXISTS `fabb_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(32) NOT NULL,
  `cat_order` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB;

--
-- Structure de la table `fabb_config`
--

CREATE TABLE IF NOT EXISTS `fabb_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL
) ENGINE=MyISAM;

--
-- Déchargement des données de la table `fabb_config`
--

INSERT INTO `fabb_config` (`config_name`, `config_value`) VALUES
('avatar_maxsize', '12000'),
('avatar_maxh', '100'),
('avatar_maxw', '100'),
('signat_strlen', '128'),
('auth_bbcode', 'oui'),
('pseudo_maxsize', '32'),
('pseudo_minsize', '3'),
('topic_par_page', '25'),
('post_par_page', '15'),
('temps_flood', '30'),
('forum_titre', 'Forum-fabb'),
('slogan_1', 'Forum Libre et Gratuit Pour Tout Le Monde'),
('slogan_2', 'Fabb est une expérience communautaire inédite.Intuitif, Social, responsive, Simple, Rapide et Freindly apporte une nouvelle vision par la qualité et la richesse de ses options.'),
('badword_par_page', '25'),
('members_par_page', '25'),
('admin_email', 'admin@forum-fabb.com'),
('search_par_page', '10'),
('lien_linkedin', 'https://www.linkedin.com/in/faci-dev'),
('lien_twitter', 'https://twitter.com/faci_dev'),
('lien_facebook', 'https://www.facebook.com/forum.fabb'),
('raison_sociale', 'fabb'),
('website_title', 'forum-fabb.com'),
('periode_inactif', '6'),
('admin_topic_par_page', '25'),
('auth_smiley', 'oui'),
('copyright', '2018');

--
-- Structure de la table `fabb_contact`
--

CREATE TABLE IF NOT EXISTS `fabb_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_idm` int(11) NOT NULL,
  `contact_object` varchar(255) NOT NULL,
  `contact_text` text NOT NULL,
  `contact_date` int(11) NOT NULL,
  `contact_read` enum('1','0') NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM;

--
-- Structure de la table `fabb_description_page`
--

CREATE TABLE IF NOT EXISTS `fabb_description_page` (
  `description_page` varchar(255) NOT NULL,
  `description_value` text NOT NULL
) ENGINE=MyISAM;

--
-- Déchargement des données de la table `fabb_description_page`
--

INSERT INTO `fabb_description_page` (`description_page`, `description_value`) VALUES
('forum/index', 'forum fabb est un forum gratuit et libre pour tout le monde ');

--
-- Structure de la table `fabb_flood`
--

CREATE TABLE IF NOT EXISTS `fabb_flood` (
  `flood_id` int(11) NOT NULL AUTO_INCREMENT,
  `flood_ip` varchar(18) NOT NULL DEFAULT '',
  `flood_time` int(11) NOT NULL DEFAULT 0,
  `flood_idm` int(11) NOT NULL,
  `flood_act` varchar(16) NOT NULL,
  PRIMARY KEY (`flood_id`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_forum`
--

CREATE TABLE IF NOT EXISTS `fabb_forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_cat_id` int(11) NOT NULL,
  `forum_name` varchar(30) NOT NULL,
  `forum_desc` text NOT NULL,
  `forum_order` mediumint(8) NOT NULL,
  `forum_last_post_id` int(11) NOT NULL,
  `forum_group` varchar(12) NOT NULL,
  `forum_topic` mediumint(8) NOT NULL,
  `forum_post` mediumint(8) NOT NULL,
  `forum_auth_view` tinyint(4) NOT NULL,
  `forum_auth_post` tinyint(4) NOT NULL,
  `forum_auth_topic` tinyint(4) NOT NULL,
  `forum_auth_annonce` tinyint(4) NOT NULL,
  `forum_auth_modo` tinyint(4) NOT NULL,
  PRIMARY KEY (`forum_id`),
  KEY `forum_cat_id` (`forum_cat_id`),
  FOREIGN KEY (`forum_cat_id`) REFERENCES `fabb_cat` (`cat_id`) ON DELETE CASCADE
) ENGINE=InnoDB;

--
-- Structure de la table `fabb_friends`
--

CREATE TABLE IF NOT EXISTS `fabb_friends` (
  `friend_from` int(11) NOT NULL,
  `friend_to` int(11) NOT NULL,
  `friend_confirm` enum('0','1') NOT NULL,
  `friend_since` int(11) NOT NULL,
  PRIMARY KEY (`friend_to`,`friend_from`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_members`
--

CREATE TABLE IF NOT EXISTS `fabb_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_pseudo` varchar(30) NOT NULL,
  `member_mdp` varchar(512) NOT NULL,
  `member_email` varchar(250) NOT NULL,
  `member_phone` varchar(20) DEFAULT NULL,
  `member_level` tinyint(4) DEFAULT NULL,
  `member_signature` varchar(200) DEFAULT NULL,
  `member_name` varchar(32) DEFAULT NULL,
  `member_forname` varchar(32) DEFAULT NULL,
  `member_age` varchar(10) DEFAULT NULL,
  `member_gender` enum('undefined','homme','femme') NOT NULL,
  `member_work` varchar(128) DEFAULT NULL,
  `member_avatar` varchar(100) DEFAULT NULL,
  `member_warning` int(3) DEFAULT '0',
  `member_ban_reason` text,
  `member_location` varchar(100) DEFAULT NULL,
  `member_registred` int(11) DEFAULT NULL,
  `member_website` varchar(255) DEFAULT NULL,
  `member_last_visit` int(11) DEFAULT NULL,
  `member_post` int(11) DEFAULT NULL,
  `member_ip` varchar(64) DEFAULT NULL,
  `member_key` varchar(512) DEFAULT NULL,
  `member_notify` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_online`
--

CREATE TABLE IF NOT EXISTS `fabb_online` (
  `online_id` int(11) NOT NULL,
  `online_time` int(11) NOT NULL,
  `online_ip` varchar(64) NOT NULL,
  `online_country` varchar(255) NOT NULL,
  `online_city` varchar(255) NOT NULL,
  `online_code` varchar(255) NOT NULL,
  `online_platform` varchar(255) NOT NULL,
  `online_browser` varchar(255) NOT NULL,
  PRIMARY KEY (`online_ip`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_page_adds`
--

CREATE TABLE IF NOT EXISTS `fabb_page_adds` (
  `page_id` smallint(2) NOT NULL,
  `page_name` varchar(64) NOT NULL
) ENGINE=MyISAM ;

--
-- Structure de la table `fabb_pic`
--

CREATE TABLE IF NOT EXISTS `fabb_pic` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_title` varchar(255) NOT NULL,
  `pic_file` varchar(255) NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB ;

--
-- Déchargement des données de la table `fabb_pic`
--

INSERT INTO `fabb_pic` (`pic_id`, `pic_title`, `pic_file`) VALUES
(1, 'photo forum', 'responsive.png');

--
-- Structure de la table `fabb_pmsgs`
--

CREATE TABLE IF NOT EXISTS `fabb_pmsgs` (
  `pmsg_id` int(11) NOT NULL AUTO_INCREMENT,
  `pmsg_sender` int(11) NOT NULL,
  `pmsg_recept` int(11) NOT NULL,
  `pmsg_object` varchar(100) NOT NULL,
  `pmsg_text` text NOT NULL,
  `pmsg_time` int(11) NOT NULL,
  `pmsg_read` enum('0','1') NOT NULL,
  PRIMARY KEY (`pmsg_id`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_topic`
--

CREATE TABLE IF NOT EXISTS `fabb_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_forum_id` int(11) NOT NULL,
  `topic_title` varchar(255) NOT NULL,
  `topic_owner` int(11) NOT NULL,
  `topic_viewed` mediumint(11) NOT NULL,
  `topic_time` int(15) NOT NULL,
  `topic_sort` varchar(16) NOT NULL,
  `topic_lastpost` int(11) NOT NULL,
  `topic_firstpost` int(11) NOT NULL,
  `topic_post` mediumint(11) NOT NULL,
  `topic_locked` enum('0','1') NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_forum_id` (`topic_forum_id`),
  FOREIGN KEY (`topic_forum_id`) REFERENCES `fabb_forum` (`forum_id`) ON DELETE CASCADE
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_post`
--

CREATE TABLE IF NOT EXISTS `fabb_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_owner` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `post_time` int(11) NOT NULL,
  `post_topic_id` int(11) NOT NULL,
  `post_forum_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fabb_post_ibfk_1` (`post_topic_id`),
  FOREIGN KEY (`post_topic_id`) REFERENCES `fabb_topic` (`topic_id`) ON DELETE CASCADE
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_pseudos`
--

CREATE TABLE IF NOT EXISTS `fabb_pseudos` (
  `pseudo_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `pseudo_value` varchar(32) NOT NULL,
  PRIMARY KEY (`pseudo_id`)
) ENGINE=MyISAM ;

--
-- Structure de la table `fabb_smtp`
--

CREATE TABLE IF NOT EXISTS `fabb_smtp` (
  `smtp_id` smallint(2) NOT NULL AUTO_INCREMENT,
  `smtp_name` varchar(64) NOT NULL,
  `smtp_host` varchar(128) NOT NULL,
  `smtp_port` mediumint(5) NOT NULL,
  `smtp_user` varchar(256) NOT NULL,
  `smtp_psw` varchar(256) NOT NULL,
  `smtp_crypt` enum('ssl','tls') NOT NULL,
  `smtp_charset` varchar(128) NOT NULL,
  `smtp_mailtype` enum('text','html') NOT NULL,
  `smtp_active` enum('1','0') NOT NULL,
  PRIMARY KEY (`smtp_id`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_testimo`
--

CREATE TABLE IF NOT EXISTS `fabb_testimo` (
  `testimo_idM` int(11) NOT NULL,
  `testimo_date` varchar(32) NOT NULL,
  `testimo_text` varchar(256)  NOT NULL,
  PRIMARY KEY (`testimo_idM`)
) ENGINE=MyISAM;

--
-- Structure de la table `fabb_title_page`
--

CREATE TABLE IF NOT EXISTS `fabb_title_page` (
  `title_page` varchar(255) NOT NULL,
  `title_value` text NOT NULL
) ENGINE=MyISAM ;

--
-- Déchargement des données de la table `fabb_title_page`
--

INSERT INTO `fabb_title_page` (`title_page`, `title_value`) VALUES
('forum/index', 'forum fabb');

--
-- Structure de la table `fabb_topic_view`
--

CREATE TABLE IF NOT EXISTS `fabb_topic_view` (
  `tv_id` int(11) NOT NULL,
  `tv_topic_id` int(11) NOT NULL,
  `tv_forum_id` int(11) NOT NULL,
  `tv_post_id` int(11) NOT NULL,
  `tv_post` enum('0','1') NOT NULL,
  PRIMARY KEY (`tv_id`,`tv_topic_id`)
) ENGINE=InnoDB ;

--
-- Structure de la table `fabb_version`
--

CREATE TABLE IF NOT EXISTS `fabb_version` (
  `version_id` tinyint(2) NOT NULL,
  `version_number` varchar(9) NOT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=MyISAM ;

--
-- Déchargement des données de la table `fabb_version`
--

INSERT INTO `fabb_version` (`version_id`, `version_number`) VALUES
(1, '3.0.0');
