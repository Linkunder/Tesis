<?php 
	include_once 'libs/SiteConfig.php';

	$config = SiteConfig::singleton();
	 
	$config->set('controllersFolder', 'controllers/');
	$config->set('modelsFolder', 'models/');
	$config->set('viewsFolder', 'views/');
	 
	$config->set('dbhost', 'localhost');
	$config->set('dbname', 'DBTesis');
	$config->set('dbuser', 'root');
	$config->set('dbpass', '');
?>