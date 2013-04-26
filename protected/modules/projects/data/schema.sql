CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,

  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `phone` varchar(30) default '',
  `fax` varchar(30) default NULL,
  `address` varchar(255) default NULL,
  `city` varchar(30) default NULL,
  `state` varchar(30) default NULL,
  `zip` varchar(11) default NULL,
  `url` varchar(25) default NULL,
  PRIMARY KEY  (`id`)
) COMMENT='Department heirarchy under a company. Root = 0 to refer to a company.';

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` varchar(30) default NULL,
  `last_name` varchar(30) default NULL,
  `order_by` varchar(30) NOT NULL default '',
  `title` varchar(50) default NULL,
  `birthday` date default NULL,
  `job` varchar(255) default NULL,
  `company` varchar(100) NOT NULL default '',
  `department` TINYTEXT,
  `type` varchar(20) default NULL,
  `email` varchar(255) default NULL,
  `email2` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `phone` varchar(30) default NULL,
  `phone2` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `address1` varchar(60) default NULL,
  `address2` varchar(60) default NULL,
  `city` varchar(30) default NULL,
  `state` varchar(30) default NULL,
  `zip` varchar(11) default NULL,
  `country` varchar(30) default NULL,
  `jabber` varchar(255) default NULL,
  `icq` varchar(20) default NULL,
  `msn` varchar(255) default NULL,
  `yahoo` varchar(255) default NULL,
  `aol` varchar(30) default NULL,
  `notes` text,
  `project` int(11) NOT NULL default '0',
  `icon` varchar(20) default 'obj/contact',
  `owner` int unsigned default '0',
  `private` tinyint unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_oby` (`order_by`),
  KEY `idx_co` (`company`),
  KEY `idx_prp` (`project`)
) ;

CREATE TABLE `events` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `start_date` datetime default null,
  `end_date` datetime default null,
  `parent` int(11) unsigned NOT NULL default '0',
  `description` text,
  `times_recuring` int(11) unsigned NOT NULL default '0',
  `recurs` int(11) unsigned NOT NULL default '0',
  `remind` int(10) unsigned NOT NULL default '0',
  `icon` varchar(20) default 'obj/event',
  `owner` int(11) default '0',
  `project` int(11) default '0',
  `private` tinyint(3) default '0',
  `type` tinyint(3) default '0',
  `cwd` tinyint(3) default '0',
	`notify` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_esd` (`start_date`),
  KEY `id_eed` (`end_date`),
  KEY `id_evp` (`parent`),
	KEY `idx_ev1` (`owner`),
	KEY `idx_ev2` (`project`)
) ;

CREATE TABLE `event_queue` (
  `id` int(11) NOT NULL auto_increment,
  `start` int(11) NOT NULL default '0',
  `type` varchar(40) NOT NULL default '',
  `repeat_interval` int(11) NOT NULL default '0',
  `repeat_count` int(11) NOT NULL default '0',
  `data` longblob NOT NULL,
  `callback` varchar(127) NOT NULL default '',
  `owner` int(11) NOT NULL default '0',
  `origin_id` int(11) NOT NULL default '0',
  `module` varchar(40) NOT NULL default '',
  `module_type` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `start` (`start`),
  KEY `module` (`module`),
  KEY `type` (`type`),
  KEY `origin_id` (`origin_id`)
) ;


CREATE TABLE `files` (
  `id` int(11) NOT NULL auto_increment,
  `real_filename` varchar(255) NOT NULL default '',
  `folder` int(11) NOT NULL default '0',
  `project` int(11) NOT NULL default '0',
  `task` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `parent` int(11) default '0',
  `description` text,
  `type` varchar(100) default NULL,
  `owner` int(11) default '0',
  `date` datetime default NULL,
  `size` int(11) default '0',
  `version` float NOT NULL default '0',
  `icon` varchar(20) default 'obj/',
  `category` int(11) default '0',
	`checkout` varchar(255) not null default '',
	`co_reason` text,
	`version_id` int(11) not null default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_task` (`task`),
  KEY `idx_project` (`project`),
  KEY `idx_parent` (`parent`),
	KEY `idx_vid` (`version_id`)
) ;

CREATE TABLE `files_index` (
  `file_id` int(11) NOT NULL default '0',
  `word` varchar(50) NOT NULL default '',
  `word_placement` int(11) NOT NULL default '0',
  PRIMARY KEY  (`file_id`,`word`, `word_placement`),
  KEY `idx_fwrd` (`word`)
) ;

CREATE TABLE `forum_messages` (
  `id` int(11) NOT NULL auto_increment,
  `forum` int(11) NOT NULL default '0',
  `parent` int(11) NOT NULL default '0',
  `author` int(11) NOT NULL default '0',
  `editor` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `date` datetime default '0000-00-00 00:00:00',
  `body` text,
  `published` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `idx_mparent` (`parent`),
  KEY `idx_mdate` (`date`),
  KEY `idx_mforum` (`forum`)
) ;

CREATE TABLE `forums` (
  `id` int(11) NOT NULL auto_increment,
  `project` int(11) NOT NULL default '0',
  `status` tinyint(4) NOT NULL default '-1',
  `owner` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `create_date` datetime default '0000-00-00 00:00:00',
  `last_date` datetime default '0000-00-00 00:00:00',
  `last_id` INT UNSIGNED DEFAULT '0' NOT NULL,
  `message_count` int(11) NOT NULL default '0',
  `description` varchar(255) default NULL,
  `moderated` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_fproject` (`project`),
  KEY `idx_fowner` (`owner`),
  KEY `status` (`status`)
) ;

CREATE TABLE `forum_watch` (
  `user` int(10) unsigned NOT NULL default '0',
  `forum` int(10) unsigned default NULL,
  `topic` int(10) unsigned default NULL,
	KEY `idx_fw1` (`user`, `forum`),
	KEY `idx_fw2` (`user`, `topic`)
) COMMENT='Links users to the forums/messages they are watching';

CREATE TABLE `forum_visits` (
  `user` INT(10) NOT NULL DEFAULT 0,
  `forum` INT(10) NOT NULL DEFAULT 0,
  `message` INT(10) NOT NULL DEFAULT 0,
  `date` TIMESTAMP,
  KEY `idx_fv` (`user`, `forum`, `message`)
) ;


CREATE TABLE `projects` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL COMMENT 'Ten du an',
  `description` text COMMENT 'Mo ta cho du an',
  `alias` varchar(10) default NULL COMMENT 'Machine name cho du an',

  `target_budget` double default '0.00',
  `actual_budget` double default '0.00',

  `start_date` datetime default NULL,
  `end_date` datetime default NULL,

  `priority` tinyint(4) default '0',
  `private` tinyint(3) unsigned default '0',
  `status` int(11) default '0',

  `percent_complete` tinyint(4) default '0',

  `company` int(11) NOT NULL default '0',
  `company_internal` int(11) NOT NULL default '0',
  `department` int(11) NOT NULL default '0',
  `owner` int(11) default '0',

  `url` varchar(255) default NULL,
  `demo_url` varchar(255) default NULL,

  `color_identifier` varchar(6) default 'eeeeee',
  `creator` int(11) default '0',
  `departments` CHAR( 100 ) ,
  `contacts` CHAR( 100 ) ,
  PRIMARY KEY  (`id`),
  KEY `idx_owner` (`owner`),
  KEY `idx_sdate` (`start_date`),
  KEY `idx_edate` (`end_date`),
  KEY `short_name` (`short_name`),
	KEY `idx_proj1` (`company`)

) ;

CREATE TABLE `project_contact` (
  `pid` INT(10) NOT NULL,
  `cid` INT(10) NOT NULL
) ;

CREATE TABLE `project_department` (
  `pid` INT(10) NOT NULL,
  `did` INT(10) NOT NULL
) ;

CREATE TABLE `task_log` (
  `id` INT(11) NOT NULL auto_increment,
  `task` INT(11) NOT NULL default '0',
  `title` VARCHAR(255) default NULL,
  `description` TEXT,
  `creator` INT(11) NOT NULL default '0',
  `hours` FLOAT DEFAULT "0" NOT NULL,
  `date` DATETIME,
  `costcode` VARCHAR(8) NOT NULL default '',
  `problem` TINYINT( 1 ) DEFAULT '0',
  `reference` TINYINT( 4 ) DEFAULT '0',
  `related_url` VARCHAR( 255 ) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_log_task` (`task`)
) ;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `parent` int(11) default '0',
  `milestone` tinyint(1) default '0',
  `project` int(11) NOT NULL default '0',
  `owner` int(11) NOT NULL default '0',
  `start_date` datetime default NULL,
  `duration` float unsigned default '0',
  `duration_type` int(11) NOT NULL DEFAULT 1,
  `hours_worked` float unsigned default '0',
  `end_date` datetime default NULL,
  `status` int(11) default '0',
  `priority` tinyint(4) default '0',
  `percent_complete` tinyint(4) default '0',
  `description` text,
  `target_budget` decimal(10,2) default '0.00',
  `related_url` varchar(255) default NULL,
  `creator` int(11) NOT NULL default '0',
  `order` int(11) NOT NULL default '0',
  `client_publish` tinyint(1) NOT NULL default '0',
  `dynamic` tinyint(1) NOT NULL default 0,
  `access` int(11) NOT NULL default '0',
  `notify` int(11) NOT NULL default '0',
  `departments` CHAR( 100 ),
  `contacts` CHAR( 100 ),
  `custom` LONGTEXT,
  `type` SMALLINT DEFAULT '0' NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_parent` (`parent`),
  KEY `idx_project` (`project`),
  KEY `idx_owner` (`owner`),
  KEY `idx_order` (`order`),
	KEY `idx_task1` (`start_date`),
	KEY `idx_task2` (`end_date`)
) ;

CREATE TABLE `task_contact` (
  `tid` INT(10) NOT NULL,
  `cid` INT(10) NOT NULL
) ;

CREATE TABLE `task_department` (
  `tid` INT(10) NOT NULL,
  `did` INT(10) NOT NULL
) ;

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `company` int(10) NOT NULL default '0',
  `project` int(10) NOT NULL default '0',
  `author` varchar(100) NOT NULL default '',
  `recipient` varchar(100) NOT NULL default '',
  `attachment` tinyint(1) unsigned NOT NULL default '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  `type` varchar(15) NOT NULL default '',
  `assignment` int(10) unsigned NOT NULL default '0',
  `parent` int(10) unsigned NOT NULL default '0',
  `activity` int(10) unsigned NOT NULL default '0',
  `priority` tinyint(1) unsigned NOT NULL default '1',
  `cc` varchar(255) NOT NULL default '',
  `signature` text,
  PRIMARY KEY  (`ticket`),
  KEY `parent` (`parent`),
  KEY `type` (`type`)
) ;

CREATE TABLE `user_events` (
	`uid` int(11) NOT NULL default '0',
	`eid` int(11) NOT NULL default '0'
) ;

CREATE TABLE `user_tasks` (
  `uid` int(11) NOT NULL default '0',
  `tid` int(11) NOT NULL default '0',
  `priority` tinyint(4) default '0',
  PRIMARY KEY  (`user_id`,`task_id`)
) ;


CREATE TABLE `task_dependencies` (
    `dependencies_task_id` int(11) NOT NULL,
    `dependencies_req_task_id` int(11) NOT NULL,
    PRIMARY KEY (`dependencies_task_id`, `dependencies_req_task_id`)
);

CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `author` int(10) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `body` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `hours` float NOT NULL default '0',
  `code` varchar(8) NOT NULL default '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) ;
