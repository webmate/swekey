-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_user`
-- 

CREATE TABLE `tl_user` (
  `swekey_id` varchar(32) NOT NULL default '',
  `swekey_forceLogin` varchar(7) NOT NULL default 'global',
  KEY `swekey_id` (`swekey_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_user_group`
-- 

CREATE TABLE `tl_user_group` (
  `swekey_forceLogin` varchar(7) NOT NULL default 'global',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;