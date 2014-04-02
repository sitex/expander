<?php

class ExpanderActivation {

	public function beforeActivation(&$controller) {
		return true;
	}

	public function onActivation(&$controller) {
		$CroogoPlugin = new CroogoPlugin();

		$Setting = ClassRegistry::init('Settings.Setting');
		$Setting->write('Expander.installed', true);

		return true;
	}

	public function beforeDeactivation(&$controller) {
		return true;
	}

	public function onDeactivation(&$controller) {
		$Setting = ClassRegistry::init('Settings.Setting');
		$Setting->deleteKey('Expander.installed');
	}

}
