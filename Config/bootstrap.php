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

$title = __d('expander', 'Expander');
$element = 'Expander.admin/meta';
$options = array(
	'elementData' => array(
		'field' => 'body',
	),
);
Croogo::hookAdminTab('Nodes/admin_add', $title, $element, $options);
Croogo::hookAdminTab('Nodes/admin_edit', $title, $element, $options);
