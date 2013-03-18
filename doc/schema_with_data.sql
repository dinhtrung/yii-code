-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2011 at 11:47 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_realtimepbx`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

DROP TABLE IF EXISTS `authassignment`;
CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

DROP TABLE IF EXISTS `authitem`;
CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('Agent', 2, 'Các điện thoại viên trên hệ thống.', NULL, 'N;'),
('Agent Supervisor', 2, 'Quản lý các điện thoại viên', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

DROP TABLE IF EXISTS `authitemchild`;
CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitemchild`
--


-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE IF NOT EXISTS `block` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` int(11) unsigned DEFAULT NULL,
  `option` text,
  `status` tinyint(1) DEFAULT '1',
  `url` text,
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`bid`, `title`, `label`, `description`, `type`, `option`, `status`, `url`, `display`) VALUES
(1, 'Demo Menu Portlet', 'Demo Menu Portlet', 'Portlet động, được cấu hình thông qua hàm callback.', 1, 'a:2:{s:4:"root";s:1:"2";s:5:"level";s:1:"5";}', 1, NULL, 0),
(2, 'Another Menu', 'Another Menu', 'Another Menu on the Fly.', 1, 'a:2:{s:4:"root";s:1:"3";s:5:"level";s:1:"5";}', 1, NULL, 0),
(3, 'Node Tags', 'Tags', 'All the tags associated with the Node type.', 2, NULL, 1, NULL, 0),
(4, 'Tree Menu Portlet', 'Sample Tree Menu', 'This just another Tree Menu.', 3, 'a:2:{s:4:"root";s:1:"3";s:5:"level";s:1:"2";}', 0, NULL, 0),
(5, 'TEST NivoSlider Portlet', 'Sample NivoSlider Portlet', 'For now, the block module has significant changes.\r\n\r\nView file can access the block by $block variable.\r\n\r\nSo it can customize its own views, to display a more specific Portlet.\r\n\r\nBlock now can be configure per themes. The relationship is One Block - One Region Many Theme.', 4, 'a:2:{s:4:"root";s:2:"20";s:5:"level";s:1:"5";}', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blocktheme`
--

DROP TABLE IF EXISTS `blocktheme`;
CREATE TABLE IF NOT EXISTS `blocktheme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `block` int(11) unsigned NOT NULL,
  `theme` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `weight` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `block` (`block`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blocktheme`
--

INSERT INTO `blocktheme` (`id`, `block`, `theme`, `region`, `weight`) VALUES
(3, 1, 'blueribbon', 'sidebar', 8),
(4, 1, 'classic', 'sidebar', 5),
(5, 5, 'blueribbon', 'sidebar', 7);

-- --------------------------------------------------------

--
-- Table structure for table `blocktype`
--

DROP TABLE IF EXISTS `blocktype`;
CREATE TABLE IF NOT EXISTS `blocktype` (
  `btid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `component` varchar(255) DEFAULT NULL,
  `callback` varchar(255) DEFAULT NULL,
  `viewfile` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`btid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blocktype`
--

INSERT INTO `blocktype` (`btid`, `title`, `description`, `component`, `callback`, `viewfile`, `config`) VALUES
(1, 'Dynamic Menu Portlet', 'A dynamic menu portlet.\r\nThe Component should be application.models.WebMenu\r\nIt must have a call back function named getMenuData() to provide the view file with needed data.\r\nThe getMenuData() will have 2 arguments: The level of the menu that will be render, and the root of the menu tree.\r\nTo configure a block of this type, the Block module must configure through WebMenu::getMenuConfig() function.', 'core.models.WebMenu', 'getMenu', 'core.views.webMenu.blocks.menuPortlet', NULL),
(2, 'Node TagWidget', 'Display all the Tags belongs to node.', NULL, NULL, 'core.views.node.blocks.tagPortlet', NULL),
(3, 'Tree Menu Portlet', NULL, 'core.models.WebMenu', 'getMenu', 'core.views.webmenu.menuTreePortlet', NULL),
(4, 'Gallery Nivo Slider', 'Display Gallery image as a Menu to other resource on the webpage.\r\n\r\nAll the image in the Gallery will be used as a Nivo Slider widgets.\r\n\r\n    @see core.models.Gallery.getRootConfig\r\n    @see core.models.Gallery.getRootData', 'core.models.Gallery', 'getBlock', 'core.views.gallery.blocks.nivoSlider', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `root`, `lft`, `rgt`, `level`, `title`, `description`) VALUES
(1, 1, 1, 8, 1, 'Project Documentation', 'Project Documentation, guidelines.'),
(2, 1, 6, 7, 2, 'Database Schema', 'Documents for Database Schema'),
(3, 1, 2, 3, 2, 'Sample Source code', 'Example Source code'),
(4, 4, 1, 8, 1, 'Asterisk', 'Asterisk Documentation'),
(5, 4, 2, 3, 2, 'Commands', 'Asterisk Commands'),
(6, 4, 4, 5, 2, 'Applications', 'Asterisk Applications'),
(7, 4, 6, 7, 2, 'Dialplan', 'Asterisk Dialplan in use.'),
(8, 1, 4, 5, 2, 'TODO', 'Các task còn lại trên hệ thống.'),
(9, 9, 1, 8, 1, 'Dialplan Context', 'This category will be used as a reference to create various dialplan application.\r\nThe purpose of this usage is to manage the context structural.'),
(10, 9, 2, 3, 2, 'inbound', 'This context is used for inbound calls.'),
(11, 9, 4, 5, 2, 'outbound', 'This context is used for outbound.'),
(12, 9, 6, 7, 2, 'local', 'This context is for calling local extension'),
(13, 13, 1, 10, 1, 'Gallery', 'Module Gallery get use of the Category structure to provide Tree nested set feature.'),
(14, 14, 1, 8, 1, 'Realtime Dialplan', 'This category will contain all the registered Realtime Dialplan for the system.'),
(15, 14, 2, 3, 2, 'inbound', 'This is the inbound context for Asterisk Realtime.\r\nTo enable this context, add this line into your configuration:\r\n\r\n    [inbound]\r\n    switch => Realtime'),
(16, 14, 4, 5, 2, 'local', 'Local extension goes here.'),
(17, 14, 6, 7, 2, 'outbound', 'Outbound Extension goes here.'),
(18, 13, 8, 9, 2, 'TEST GALLERY 1', 'Thử nghiệm tính năng tạol  GAlery.'),
(20, 13, 2, 5, 2, 'TEST GALLERY 2', 'Thử xem đổi trong Controller thì có được không.'),
(21, 13, 6, 7, 2, 'TEST GALLERY 3', 'Okay, module Gallery đã tự động nhận nút Root được cấu hình trong bảng Settings rồi.'),
(22, 13, 3, 4, 3, 'CHILD GALLERY 2.1', 'Đây là 1 nút conl'),
(23, 23, 1, 2, 1, 'Another Category As Root', 'This just a demo for Category as Root');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) NOT NULL,
  `pkey` int(11) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pkey` (`pkey`),
  KEY `entity` (`entity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `version` int(5) NOT NULL DEFAULT '1',
  `ext` varchar(255) DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `entity` varchar(255) DEFAULT NULL,
  `pkey` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entity` (`entity`),
  KEY `pkey` (`pkey`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `file`
--


-- --------------------------------------------------------

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
CREATE TABLE IF NOT EXISTS `node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `node`
--


-- --------------------------------------------------------

--
-- Table structure for table `node_tag`
--

DROP TABLE IF EXISTS `node_tag`;
CREATE TABLE IF NOT EXISTS `node_tag` (
  `nid` int(10) unsigned NOT NULL,
  `tid` int(11) unsigned NOT NULL,
  KEY `nid` (`nid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`, `birthday`) VALUES
(1, 'Admin', 'Administrator', '0000-00-00'),
(2, 'Demo', 'Demo', '0000-00-00'),
(3, 'Dinh Trung', 'Nguyen', '1985-01-14'),
(4, 'One', 'Teacher', '0000-00-00'),
(5, 'Hai', 'Teacher', '0000-00-00'),
(6, 'Three', 'Agent', '0000-00-00'),
(7, 'Hai', 'Manager', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

DROP TABLE IF EXISTS `profiles_fields`;
CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'birthday', 'Birthday', 'DATE', 0, 0, 2, '', '', '', '', '0000-00-00', 'UWjuidate', '{"ui-theme":"redmond"}', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

DROP TABLE IF EXISTS `rights`;
CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `category`, `key`, `value`) VALUES
(1, 'theme', 'perPage', 's:2:"20";'),
(2, 'theme', 'serverEmail', 's:0:"";'),
(3, 'theme', 'contactEmail', 's:0:"";'),
(4, 'theme', 'theme', 's:10:"blueribbon";'),
(5, 'theme', 'layout', 'N;'),
(6, 'theme', 'siteName', 's:13:"Internet GTel";'),
(7, 'theme', 'siteSlogan', 'N;'),
(8, 'theme', 'siteLogo', 's:0:"";'),
(9, 'article', 'image', 's:0:"";'),
(10, 'article', 'cid', 's:1:"3";'),
(11, 'article', 'alias', 's:20:"webroot.files.upload";'),
(12, 'document', 'alias', 's:21:"webroot.files.uploads";'),
(13, 'document', 'image', 's:0:"";'),
(14, 'document', 'cid', 's:1:"1";'),
(15, 'document', 'file', 's:0:"";'),
(16, 'phpagi', 'server', 's:9:"localhost";'),
(17, 'phpagi', 'port', 's:4:"5038";'),
(18, 'phpagi', 'username', 's:6:"phpagi";'),
(19, 'phpagi', 'secret', 's:6:"phpagi";'),
(20, 'realtimepbx.Queue', 'context', 's:14:"queue-realtime";'),
(21, 'Extensions', 'context', 's:2:"14";'),
(22, 'Extensions', 'exten', 's:0:"";'),
(23, 'Extensions', 'priority', 's:1:"0";'),
(24, 'Extensions', 'app', 's:0:"";'),
(25, 'Extensions', 'appdata', 's:0:"";'),
(26, 'Gallery', 'root', 's:2:"13";'),
(27, 'Queue', 'context', 's:5:"queue";');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `frequency`) VALUES
(1, 'dialplan', 2),
(2, 'design', 2),
(3, 'device', 2),
(4, 'extension', 2),
(5, 'alphapager', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', 1261146094, 1310972344, 1, 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', 1261146096, 0, 0, 1),
(3, 'ndtrung', 'e10adc3949ba59abbe56e057f20f883e', 'ndtrung@istt.com.vn', 'ee1ee8aaa2b5eb52e0caac370172814b', 1307011935, 0, 0, 0),
(4, 'agent1', 'e10adc3949ba59abbe56e057f20f883e', 'teacher1@yiiedupro.com', '960b2ee2774348482345e1542f11df29', 1308593633, 1308593633, 0, 1),
(5, 'agent2', 'e10adc3949ba59abbe56e057f20f883e', 'teacher2@yiiedupro.com', '4984fc9381b2b3fcf82e6d619fb36a85', 1308593660, 1308593660, 0, 1),
(6, 'agent3', 'e10adc3949ba59abbe56e057f20f883e', 'manager1@edupro.com', '7501b5a3694e2f4dcadf05fac8d8d7a5', 1308593687, 1308593687, 0, 1),
(7, 'agent4', 'e10adc3949ba59abbe56e057f20f883e', 'manager2@yiiedupro.com', '52a6e497e13067d87f941f4282e84862', 1308593711, 1308593711, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocktheme`
--
ALTER TABLE `blocktheme`
  ADD CONSTRAINT `blocktheme_ibfk_1` FOREIGN KEY (`block`) REFERENCES `block` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `node_tag`
--
ALTER TABLE `node_tag`
  ADD CONSTRAINT `node_tag_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `node_tag_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
