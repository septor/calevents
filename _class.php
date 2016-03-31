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

		$this->client->setApplicationName($this->pref['calendar_name']);
		$this->client->setDeveloperKey($this->pref['develper_api']);
		$this->calendar = new Google_Service_Calendar($this->client);

		$this->params = array(
			'singleEvents' => $this->pref['singleEvents'],
			'orderBy' => $this->pref['event_orderby'],
			'maxResults' => $this->pref['max_results']
		);
	}

	function getEvents($calendarId)
	{
		$events = $this->calendar->events->listEvents($calendarId, $this->params);
		$calTimeZone = $events->timeZone;

		date_default_timezone_set($events->timeZone);

		foreach($events->getItems() as $event)
		{
			$eventDateStr = $event->start->dateTime;
			if(empty($eventDateStr))
				$eventDateStr = $event->start->date;

			$tmpTz = $event->start->timeZone;
			if(!empty($tmpTz))
				$timezone = new DateTimeZone($tmpTz);
			else
				$timezone = new DateTimeZone($calTimeZone);

			$eventDate = new DateTime($eventDateStr, $timezone);

			$output[] = array(
				'link' => $event->htmllink,
				'timezone_link' => $event->htmllink.'&ctz='.$calTimeZone,
				'month' => $eventDate->format('M'),
				'day' => $eventDate->format('j'),
				'summary' => $event->summary
			);
		}

		return $output;
	}
}
