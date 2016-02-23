<?php

// Basic autoloader, replace with composer's own in production
spl_autoload_register(function($class){
	if(substr_compare($class, 'HybridLogic\\Slack\\', 0, 18) !== 0) {
		return false;
	}
	$file = './src/' . substr($class, 18) . '.php';
	if(is_file($file)) {
		include $file;
	}
});
