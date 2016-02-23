PHP Slack
=========

A library of useful classes for working with Slack.

At the moment this library is mainly focused on [slash commands](https://api.slack.com/slash-commands) but may grow in the future. It supports defining multiple commands and matching actions within them.

[![Build Status](https://travis-ci.org/Dachande663/PHP-Slack.png)](https://travis-ci.org/Dachande663/PHP-Slack)


0.0 Table of Contents
---------------------

* Introduction
* Examples
* Running Tests
* Troubleshooting
* Changelog


1.0 Introduction
----------------

Slack is a cross-platform messaging platform that offers multiple integrations with third-party services. One of the most useful of these integrations is in the form of [slash commands](https://api.slack.com/slash-commands) e.g.

    /cinema movies tonight

Slash commands make a HTTP POST request to a server and display the result to the user. This library aims to make dealing with these commands a bit simpler, including:

* Parsing the incoming data
* Matching text against command patterns
* Ensuring security tokens match
* Filtering available teams, channels and users
* Serving responses
* Handling delayed responses

At the moment there is no support for the Slack Web API or RTM as these have been done elsewhere by others. This library lets you get a slash command online quickly and easily. Look in the examples directory for more info.


2.0 Examples
------------

```php
Slack::dispatcher()
	->setFilter(
		Slack::filter()
			->allowedTeamIds('T01234567')
			->allowedUserIds('U01234567')
	)
	->addCommand(
		Slack::command('ABCDEF01234567')
			->on('', function(){
				return Slack::response('Welcome to this command');
			})
			->on('^say (.+)$', function($req){
				$text = $req->param(0);
				return Slack::response("Hello $text");
			})
	)
	->dispatch(Slack::request())
	->serve()
;
```


3.0 Running Tests
-----------------

phpunit tests


4.0 Troubleshooting
-------------------

Make sure you meet the requirements for running a slash command host i.e. publicly accessible and served over HTTPS.


5.0 Changelog
-------------

* **[2016-02-21]** Initial release
