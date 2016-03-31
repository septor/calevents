<?php
/*
 * Calevents - A Calendar and Event Tracker for e107
 *
 * Copyright (C) 2016 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
require_once('../../class2.php');
if (!getperms('P'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}

class calevents_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main'	=> array(
			'controller' 	=> 'calevents_ui',
			'path' 			=> null,
			'ui' 			=> 'calevents_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
		'main/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'Calevents';
}

class calevents_ui extends e_admin_ui
{

	protected $pluginTitle		= 'Calevents';
	protected $pluginName		= 'calevents';
	//	protected $eventName		= 'calevents-calevents'; // remove comment to enable event triggers in admin.
	protected $table			= 'calevents';
	protected $pid				= 'id';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	//	protected $batchCopy		= true;
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable.

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= 'id DESC';

	protected $fields = array(
		'checkboxes' => array(
			'title' => '',
			'type' => null,
			'data' => null,
			'width' => '5%',
			'thclass' => 'center',
			'forced' => '1',
			'class' => 'center',
			'toggle' => 'e-multiselect',
		),
		'id' => array(
			'title' => LAN_ID,
			'data' => 'int',
			'width' => '5%',
			'help' => '',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'calendar_id' => array(
			'title' => 'Google Calendar ID',
			'type' => 'text',
			'data' => 'str',
			'width' => '5%',
			'help' => 'The Calendar ID of the Google Calendar',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'group_name' => array(
			'title' => 'Group Name',
			'type' => 'text',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => 'The name of the group',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'group_userclass' => array(
			'title' => 'Group Access Userclass',
			'type' => 'userclass',
			'data' => 'str',
			'width' => 'auto',
			'help' => 'The userclass allowed to access this group',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'options' => array(
			'title' => LAN_OPTIONS,
			'type' => null,
			'data' => null,
			'width' => '10%',
			'thclass' => 'center last',
			'class' => 'center last',
			'forced' => '1',
		),
	);

	protected $fieldpref = array('group_name');

	protected $preftabs = array('General', 'Google API');
	protected $prefs = array(
		'nav_link_page' => array(
			'title' => 'Navigation Link Page',
			'tab' => 0,
			'type' => 'text',
			'data' => 'str',
			'help' => 'Where you want the navigation link to point to.',
		),
		'calendar_name' => array(
			'title' => 'Calendar Name',
			'tab' => 0,
			'type' => 'text',
			'data' => 'str',
			'help' => '',
		),
		'allow_single_events' => array(
			'title' => 'Allow Single Events?',
			'tab' => 0,
			'type' => 'boolean',
			'data' => 'str',
			'help' => '',
		),
		'event_orderby' => array(
			'title' => 'Event Orderby',
			'tab' => 0,
			'type' => 'text',
			'data' => 'str',
			'help' => '',
		),
		'max_results' => array(
			'title' => 'Max Results To Return',
			'tab' => 0,
			'type' => 'number',
			'data' => 'int',
			'help' => '',
		),
		'client_id' => array(
			'title' => 'Client ID',
			'tab' => 1,
			'type' =>'text',
			'data' => 'str',
			'help' => ''
		),
		'client_secret'	=> array(
			'title' => 'Client Secret',
			'tab' => 1,
			'type' =>'text',
			'data' => 'str',
			'help' => ''
		),
		'redirect_uri' => array(
			'title' => 'Redirect URI',
			'tab' => 1,
			'type' =>'text',
			'data' => 'str',
			'help' => 'Help Text goes here'
		),
		'developer_api' => array(
			'title' => 'API Key',
			'tab' => 1,
			'type' => 'text',
			'data' => 'str',
			'help' => '',
		),
	);

	public function init()
	{
	}

	public function beforeCreate($new_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
	}

	public function onCreateError($new_data, $old_data)
	{
	}

	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
	}
}

class calevents_form_ui extends e_admin_form_ui
{
}

new calevents_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
