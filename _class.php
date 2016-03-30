<?php
/*
 * Calevents - A Calendar and Event Tracker for e107
 *
 * Copyright (C) 2016 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class Calevents
{
	function __construct()
	{
		$this->pref = e107::pref('calevents');
		$this->client = new Google_Client();
		$this->clientId = $this->pref['client_id'];
		$this->clientSecret = $this->pref['client_secret'];
		$this->redirectUri = $this->pref['redirect_uri'];

		$this->client->setApplicationName($this->pref['calendar_name'];
		$this->client->setDeveloperKey($this->pref['develper_api'];
		$this->calendar = new Google_Service_Calendar($this->client);
	}

	function 
}
