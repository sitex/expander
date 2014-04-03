<?php

App::uses('Component', 'Controller');

/**
 * Expander Component
 *
 * An Expander hook component for demonstrating hook system.
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ExpanderComponent extends Component {

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
	public function startup(Controller $controller) {
		// $controller->set('expanderComponent', 'ExpanderComponent startup');
	}

/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
	public function beforeRender(Controller $controller) {

		$meta_fields = array();

		if (isset($controller->viewVars['type']['Params']['fields'])) {
			$keys = array();

			$params = $controller->viewVars['type']['Params'];
			$fields = explode(',', $params['fields']);
			foreach ($fields as $field) {
				if (isset($params[$field])) {
					// selectbox
					$options = array();
					$explode = explode(',', $params[$field]);
					foreach ($explode as $value) {
						$options[$value] = __d('expander', $value);
					}

					$keys[$field] = array(
						'label' => __d('expander', $field),
						'options' => $options,
						// 'type'  => 'textarea'
					);
				} else {
					// input
					$keys[$field] = array(
						'label' => __d('expander', $field),
						// 'type'  => 'textarea'
					);
				}
			}

			Configure::write('Expander.keys', $keys);



			$title = __d('expander', 'Expander');
			$element = 'Expander.admin/meta';
			$options = array(
				'elementData' => array(
					'field' => 'body',
				),
			);

			Croogo::hookAdminTab('Nodes/admin_add', $title, $element, $options);
			Croogo::hookAdminTab('Nodes/admin_edit', $title, $element, $options);

		}

	}

/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object $controller Controller with components to shutdown
 * @return void
 */
	public function shutdown(Controller $controller) {
	}

}
