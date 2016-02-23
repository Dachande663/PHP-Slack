<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Fluent Commands
 *
 * This library makes it very easy to quickly pull together
 * a set of commands. Each method returns it's object
 * meaning you can chain them together e.g.
 *
 *     Slack::dispatcher()
 *       ->setFilter(...)
 *       ->addCommand(...)
 *       ->addCommand(...)
 *       ->dispatch(...)
 *       ->serve();
 *
 * This lets you define commands with minimal fuss.
 **/

Slack::dispatcher()
	->setFilter(
		Slack::filter()
			->allowedTeamIds('T01234567')
			->allowedUserIds('U01234567')
	)
	->addCommand(new ExampleCommand)
	->addCommand(
		Slack::command('ABCDEF01234567')
			->on('', function($req){
				return ['text' => 'You need to send a weight'];
			})
			->on('^([1-9][0-9]*) ?(kg|lb|st)$', function($req){
				$weight = $req->param(1);
				saveToDb($weight);
				return ['text' => 'Got it!'];
			})
			->on('history', function($req){
				return ['text' => 'Previous weigh-ins...'];
			})
			->on('help', function($req){
				return ['text' => 'Send the weight'];
			})
	)
	->dispatch(Slack::request())
	->serve()
;
