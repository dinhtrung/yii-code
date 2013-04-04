-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2012 at 03:29 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_isms`
--

-- --------------------------------------------------------

--
-- authassignment, authitem, authitemchild va right la 4 bang can thiet cho module Rights, giup phan quyen he thong...
--

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(255) DEFAULT NULL COMMENT 'authitem.name',
  `userid` int(11) DEFAULT NULL COMMENT 'user.id',
  `bizrule` text COMMENT 'Business rules',
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(255) NOT NULL COMMENT 'Name of the authitem',
  `type` int(11) NOT NULL COMMENT '0|operation, 1|task, 2|role',
  `description` text COMMENT 'Not used. Use dbmessages instead.',
  `bizrule` text COMMENT 'Business rule',
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` ( 
  `parent` varchar(255) DEFAULT NULL COMMENT 'authitem.name of parent',
  `child` varchar(255) DEFAULT NULL COMMENT 'authitem.name of child'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(255) NOT NULL COMMENT 'authitem.name',
  `type` int(11) NOT NULL COMMENT '0|operation, 1|task, 2|role',
  `weight` int(11) NOT NULL COMMENT 'Order',
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

--
-- CMS Project
--
-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `bid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Block ID',
  `title` varchar(100) DEFAULT 'NULL' COMMENT 'Block Administration Title',
  `label` varchar(255) NOT NULL COMMENT 'Block label, display for end user',
  `description` text NOT NULL COMMENT 'Description for Administrators',
  `type` int(11) DEFAULT NULL COMMENT 'Blocktype.id',
  `option` text COMMENT 'Serialized parameters for this block',
  `status` int(1) DEFAULT NULL COMMENT '0:disabled, 1:enabled',
  `url` text COMMENT 'display status filtered by URL, like in Drupal CMS',
  `display` int(1) NOT NULL COMMENT '0:display except some page, 1: only some page',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blocktheme`
--

CREATE TABLE IF NOT EXISTS `blocktheme` (
  `block` int(11) DEFAULT NULL COMMENT 'block.bid',
  `theme` varchar(255) DEFAULT NULL COMMENT 'name of the theme',
  `region` varchar(40) DEFAULT NULL COMMENT 'region this theme provide',
  `weight` int(3) NOT NULL COMMENT 'order this block is rendered.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blocktype`
--

CREATE TABLE IF NOT EXISTS `blocktype` (
  `btid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'block type ID',
  `title` varchar(100) DEFAULT 'NULL' COMMENT 'Name of this block type',
  `description` text COMMENT 'description for this block type',
  `component` varchar(255) DEFAULT 'NULL' COMMENT 'Yii class path for calling this component',
  `callback` varchar(255) DEFAULT 'NULL' COMMENT 'callback function the component provide',
  `viewfile` varchar(255) DEFAULT 'NULL' COMMENT 'view file need to render',
  PRIMARY KEY (`btid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ma chuyen muc',
  `root` int(10) DEFAULT NULL COMMENT 'Chuyen muc cap tren',
  `lft` int(10) NOT NULL COMMENT 'Chuyen muc truoc',
  `rgt` int(10) NOT NULL COMMENT 'Chuyen muc sau',
  `level` int(5) NOT NULL COMMENT 'Do sau cua chuyen muc',
  `title` varchar(255) NOT NULL COMMENT 'Ten chuyen muc',
  `description` text NOT NULL COMMENT 'Mo ta cho chuyen muc',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) NOT NULL,
  `pkey` int(11) NOT NULL,
  `uid` int(10) NOT NULL COMMENT 'User.id',
  `createtime` int(10) NOT NULL,
  `visible` int(1) NOT NULL,
  `comment` text COMMENT 'Noi dung binh luan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rgt` int(10) NOT NULL,
  `level` int(5) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `template` varchar(255) DEFAULT NULL,
  `visible` int(1) NOT NULL,
  `task` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `type` text,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `node_tag`
--

CREATE TABLE IF NOT EXISTS `node_tag` (
  `nid` int(10) NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- iSMS project
--
-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `fid` int(11) NOT NULL COMMENT 'filter.id',
  `isdn` varchar(20) NOT NULL DEFAULT '' COMMENT 'Phone number of the customer',
  PRIMARY KEY (`fid`,`isdn`),
  KEY `phonenumber` (`isdn`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'Campaign ID',
  `title` varchar(40) DEFAULT '' COMMENT 'Name of the campaign',
  `description` text COMMENT 'Description along this campaign',
  `createtime` int(11) DEFAULT NULL COMMENT 'Timestamp upon create',
  `updatetime` int(11) DEFAULT NULL COMMENT 'Timestamp upon update',
  `codename` varchar(20) DEFAULT '' COMMENT 'Ma so chuong trinh nhan tin',
  `request_date` date DEFAULT NULL COMMENT 'Ngay cong van yeu cau',
  `request_owner` varchar(40) DEFAULT '' COMMENT 'Don vi yeu cau chuong trinh',
  `datasender` varchar(80) DEFAULT NULL COMMENT 'Don vi gui du lieu chuong trinh',
  `tosubscriber` text COMMENT 'Doi tuong khach hang',
  `start` datetime DEFAULT NULL COMMENT 'Thoi gian bat dau',
  `end` datetime DEFAULT NULL COMMENT 'Thoi gian het hieu luc.',
  `status` int(1) DEFAULT '0' COMMENT 'Trang thai cua chuong trinh. 0:Khong bat, 1: Duoc bat',
  `approved` tinyint(1) NOT NULL COMMENT 'Quan tri vien da xet duyet chuong trinh? 0: Chua duyet, 1: Da duyet',
  `finished` tinyint(1) NOT NULL COMMENT 'Chuong trinh da hoan thanh? 0: Kannel chua chay chuong trinh, 1: Kannel chay xong chuong trinh roi.',
  `active` tinyint(1) NOT NULL COMMENT 'Dang den gio chay chua? 0: Chua den gio chay, 1: Dang trong thoi gian chay. Xem them worktime và cpworkday',
  `sender` varchar(20) DEFAULT NULL COMMENT 'Dau so gui tin nhan',
  `ready` int(1) DEFAULT NULL COMMENT 'Trang thai nhap du lieu. 0: Chua nhap du lieu, 1: Dang nhap du lieu, 2: Da nhap xong du lieu',
  `org` int(11) DEFAULT '0' COMMENT 'Trung tam nao chay chuong trinh nay? Moi trung tam co 2 server gui tin nhan. Xem organization.id. Co bearerbox=org thi duoc chay.',
  `type` tinyint(1) DEFAULT '0' COMMENT 'Loai chuong trinh. Khong dung nua.',
  `col` int(11) DEFAULT '1' COMMENT 'So cot du lieu trong file .CSV gui len he thong.',
  `isdncol` int(11) NOT NULL DEFAULT '1' COMMENT 'Cot du lieu so dien thoai khach hang la cot thu may?',
  `template` text COMMENT 'Noi dung tin nhan gui cho khach hang.',
  `throughput` int(11) DEFAULT NULL COMMENT 'So tin nhan chon trong 1 chu ky gui tin.',
  `priority` tinyint(6) DEFAULT '0' COMMENT 'Do uu tien khi chon chuong trinh de chay. Cung do uu tien va thoi gian chay, se duoc chay dong thoi cung nhau',
  `velocity` int(11) DEFAULT '1' COMMENT 'Toc do gui tin trong moi giay',
  `cpworkday` varchar(10) NOT NULL COMMENT 'Cac ngay trong tuan duoc phep gui tin. 1:Sunday - 7:Saturday, vd: 12367',
  `emailbox` int(11) DEFAULT NULL COMMENT 'Hop thu can kiem tra noi dung tin nhan moi',
  `esubject` varchar(255) NOT NULL COMMENT 'Tieu de thu gui toi can kiem tra',
  `eattachment` varchar(255) NOT NULL COMMENT 'Ten tep tin chua noi dung moi',
  `ftpserver` int(11) DEFAULT NULL COMMENT 'Ket noi FTP de lay du lieu ve',
  `send` bigint(20) NOT NULL COMMENT 'So luong SMS dang cho gui',
  `blocksend` bigint(20) NOT NULL COMMENT 'So luong SMS block 160 ky tu dang cho gui',
  `sent` bigint(20) NOT NULL COMMENT 'So luong SMS da gui',
  `blocksent` bigint(20) NOT NULL COMMENT 'So luong SMS 160kt da gui',
  `userid` int(11) NOT NULL COMMENT 'user.id tuong ung voi ma don hang cua chuong trinh',
  `orderid` int(11) NOT NULL COMMENT 'Ma don hang tinh cho chuong trinh nay. smsorder.id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_codename` (`org`,`codename`),
  KEY `emailbox` (`emailbox`),
  KEY `fftpsetting` (`ftpserver`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

-- --------------------------------------------------------

--
-- Table structure for table `cpfile`
--

CREATE TABLE IF NOT EXISTS `cpfile` (
  `cid` int(11) NOT NULL COMMENT 'Campaign.id',
  `fid` int(11) NOT NULL COMMENT 'Datafile.id',
  `status` int(1) NOT NULL COMMENT '0:chua xu ly,1:dang xu ly, 2:da xu ly',
  PRIMARY KEY (`cid`,`fid`),
  KEY `cid` (`cid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpfilter`
--

CREATE TABLE IF NOT EXISTS `cpfilter` (
  `cid` int(11) NOT NULL COMMENT 'Campaign.id',
  `fid` int(11) NOT NULL COMMENT 'Filter.id',
  `type` int(1) NOT NULL COMMENT '0:blacklist, 1:whitelist',
  PRIMARY KEY (`cid`,`fid`),
  KEY `fid` (`fid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpworktime`
--

CREATE TABLE IF NOT EXISTS `cpworktime` (
  `cid` int(11) NOT NULL COMMENT 'Campaign.id',
  `tid` int(11) NOT NULL COMMENT 'Worktime.id',
  PRIMARY KEY (`cid`,`tid`),
  KEY `cid` (`cid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `datafile`
--

CREATE TABLE IF NOT EXISTS `datafile` (
  `fid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'File ID.',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The users.uid of the user who is associated with the file.',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the file with no path components. This may differ from the basename of the URI if the file is renamed to avoid overwriting an existing file.',
  `uri` varchar(255) NOT NULL DEFAULT '' COMMENT 'The URI to access the file (either local or remote).',
  `filemime` varchar(255) NOT NULL DEFAULT '' COMMENT 'The file’s MIME type.',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The size of the file in bytes.',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A field indicating the status of the file. Two status are defined in core: temporary (0) and permanent (1). Temporary files older than DRUPAL_MAXIMUM_TEMP_FILE_AGE will be removed during a cron run.',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'UNIX timestamp for when the file was added.',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `uri` (`uri`),
  KEY `uid` (`createtime`),
  KEY `status` (`status`),
  KEY `timestamp` (`updatetime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Stores information for uploaded files.';

-- --------------------------------------------------------

--
-- Table structure for table `emailsetting`
--

CREATE TABLE IF NOT EXISTS `emailsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(40) NOT NULL COMMENT 'IP hoac hostname cua mail server',
  `email` varchar(255) NOT NULL COMMENT 'Dia chi Email',
  `password` varchar(255) NOT NULL COMMENT 'Mat khau dang nhap',
  `option` varchar(255) NOT NULL COMMENT 'Cac tham so cua imap_open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT 'Ten cua bo loc tin nhan',
  `reply_refuse` varchar(256) DEFAULT 'Ban da tu choi thanh cong dich vu' COMMENT 'Noi dung tin nhan tra loi khi khach hang dang ky tu choi tin nhan qua bo loc nay',
  `reply_accept` varchar(256) DEFAULT 'Ban da chap nhan thanh cong dich vu' COMMENT 'Noi dung tin nhan tra loi khi khach hang dang ky nhan tin nhan qua bo loc nay',
  `reply_false_syntax` varchar(256) DEFAULT 'Ban da nhap sai cu phap',
  `description` varchar(256) DEFAULT NULL COMMENT 'Mo ta cho bo loc tin nhan nay',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ftpfilename`
--

CREATE TABLE IF NOT EXISTS `ftpfilename` (
  `cid` int(11) NOT NULL COMMENT 'Campaign.id',
  `filename` varchar(255) NOT NULL COMMENT 'Ten tep tin can tim kiem',
  `status` int(1) NOT NULL COMMENT '0:chua xu ly, 1:da xu ly',
  PRIMARY KEY (`cid`,`filename`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ftpsetting`
--

CREATE TABLE IF NOT EXISTS `ftpsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Ten ket noi FTP',
  `description` text NOT NULL COMMENT 'Thong tin mo ta',
  `hostname` varchar(40) NOT NULL COMMENT 'IP hoac hostname cua May chu FTP',
  `path` varchar(255) NOT NULL COMMENT 'Duong dan tren may chu FTP, khong co / o truoc va sau',
  `username` varchar(40) NOT NULL COMMENT 'Thong tin dang nhap neu co',
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(10) DEFAULT NULL,
  `translation` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  `module` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'bearerbox_id',
  `title` varchar(255) NOT NULL COMMENT 'Ten trung tam',
  `description` text NOT NULL COMMENT 'Mo ta di kem',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `send_sms`
--

CREATE TABLE IF NOT EXISTS `send_sms` (
  `momt` enum('MO','MT','DLR','3rd') DEFAULT NULL,
  `sender` varchar(20) DEFAULT NULL,
  `receiver` varchar(20) NOT NULL DEFAULT '',
  `udhdata` blob,
  `msgdata` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `smsc_id` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `sms_type` bigint(20) DEFAULT NULL,
  `mclass` bigint(20) DEFAULT NULL,
  `mwi` bigint(20) DEFAULT NULL,
  `coding` bigint(20) DEFAULT NULL,
  `compress` bigint(20) DEFAULT NULL,
  `validity` bigint(20) DEFAULT NULL,
  `deferred` bigint(20) DEFAULT NULL,
  `dlr_mask` bigint(20) DEFAULT NULL,
  `dlr_url` varchar(255) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `alt_dcs` bigint(20) DEFAULT NULL,
  `rpi` bigint(20) DEFAULT NULL,
  `charset` varchar(255) DEFAULT NULL,
  `boxc_id` varchar(255) DEFAULT NULL,
  `binfo` varchar(255) DEFAULT NULL,
  `campaign_id` int(9) NOT NULL DEFAULT '0',
  `bearerbox_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`campaign_id`,`receiver`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY HASH (campaign_id)
PARTITIONS 100 */;

-- --------------------------------------------------------

--
-- Table structure for table `sent_sms`
--

CREATE TABLE IF NOT EXISTS `sent_sms` (
  `momt` enum('MO','MT','DLR','3rd') DEFAULT NULL,
  `sender` varchar(20) DEFAULT NULL,
  `receiver` varchar(20) NOT NULL DEFAULT '',
  `udhdata` blob,
  `msgdata` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `smsc_id` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `sms_type` bigint(20) DEFAULT NULL,
  `mclass` bigint(20) DEFAULT NULL,
  `mwi` bigint(20) DEFAULT NULL,
  `coding` bigint(20) DEFAULT NULL,
  `compress` bigint(20) DEFAULT NULL,
  `validity` bigint(20) DEFAULT NULL,
  `deferred` bigint(20) DEFAULT NULL,
  `dlr_mask` bigint(20) DEFAULT NULL,
  `dlr_url` varchar(255) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `alt_dcs` bigint(20) DEFAULT NULL,
  `rpi` bigint(20) DEFAULT NULL,
  `charset` varchar(255) DEFAULT NULL,
  `boxc_id` varchar(255) DEFAULT NULL,
  `binfo` varchar(255) DEFAULT NULL,
  `campaign_id` int(9) NOT NULL DEFAULT '0',
  `bearerbox_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`campaign_id`,`receiver`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY HASH (campaign_id)
PARTITIONS 100 */;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`category`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smsorder`
--

CREATE TABLE IF NOT EXISTS `smsorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `expired` datetime NOT NULL,
  `smscount` bigint(20) NOT NULL,
  `smsleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sourcemessage`
--

CREATE TABLE IF NOT EXISTS `sourcemessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `syntax`
--

CREATE TABLE IF NOT EXISTS `syntax` (
  `fid` int(11) NOT NULL,
  `syntax` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`fid`,`syntax`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) DEFAULT '',
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE IF NOT EXISTS `whitelist` (
  `fid` int(11) NOT NULL,
  `isdn` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`fid`,`isdn`),
  KEY `phonenumber` (`isdn`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `worktime`
--

CREATE TABLE IF NOT EXISTS `worktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `YiiLog`
--

-- --------------------------------------------------------

--
-- User module
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL,
  `field_size_min` int(3) NOT NULL,
  `required` int(1) NOT NULL,
  `match` varchar(255) NOT NULL,
  `range` varchar(255) NOT NULL,
  `error_message` varchar(255) NOT NULL,
  `other_validator` text NOT NULL,
  `default` varchar(255) NOT NULL,
  `widget` varchar(255) NOT NULL,
  `widgetparams` text NOT NULL,
  `position` int(3) NOT NULL,
  `visible` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL,
  `createtime` int(10) NOT NULL,
  `lastvisit` int(10) NOT NULL,
  `role` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `org` int(11) NOT NULL,
  `sender` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;



CREATE TABLE IF NOT EXISTS `YiiLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `logtime` int(11) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;
