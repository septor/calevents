CREATE TABLE calevents (
	`id` int(10) unsigned NOT NULL auto_increment,
	`calendar_id` varchar(255) default NULL,
	`group_name` varchar(255) NOT NULL default '',
	`group_userclass` varchar(255) NOT NULL default '',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;
