<?php

App::uses('ModelBehavior', 'Model');

class ExpanderCustomFieldsBehavior extends ModelBehavior {

	public function implementedEvents() {
		return array(
			'Model.Node.beforeSaveNode' => array(
				'callable' => 'onBeforeSaveNode',
			),
		);
	}

	public function afterFind(Model $model, $results, $primary = false) {
		if (!$primary) {
			return $results;
		}
		foreach ($results as &$result) {
			if (!isset($result['Meta'])) {
				continue;
			}
			foreach ($result['Meta'] as $index => $meta) {
				$result['Expander'][$meta['key']] = array_intersect_key($meta, array('id' => '', 'key' => '', 'value' => ''));
				unset($result['Meta'][$index]);
			}
		}
		return $results;
	}

}
