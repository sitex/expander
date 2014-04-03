<?php

$cacheConfig = array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('expander'))
);
CroogoCache::config('expander', $cacheConfig);

Configure::write('Expander.keys', array());

$queryString = env('QUERY_STRING');
if (strpos($queryString, 'admin') === false) {
	return;
}

/*
 * stuff for /admin routes only
 */

Croogo::hookComponent('*', 'Expander.Expander');

Croogo::hookBehavior('Node', 'Expander.ExpanderCustomFields', array(
	'priority' => 1,
));
