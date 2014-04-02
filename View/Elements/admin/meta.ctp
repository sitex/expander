<?php
$id = !empty($this->data[$this->Form->defaultModel]['id']) ?
	$this->data[$this->Form->defaultModel]['id'] :
	null;

$keys = Configure::read('Expander.keys');
$fields = array(
	'id' => array('type' => 'hidden'),
	'model' => array('type' => 'hidden'),
	'foreign_key' => array('type' => 'hidden'),
	'key' => array('type' => 'hidden'),
	'value' => array('type' => 'textarea'),
);

foreach ($keys as $key => $keyOptions):
	foreach ($fields as $field => $options):
		$input = sprintf('Expander.%s.%s', $key, $field);
		if ($field === 'id' && empty($this->data['Expander'][$key]['id'])):
			$options['value'] = String::uuid();
		endif;
		if ($field === 'model'):
			$options['value'] = $this->Form->defaultModel;
		endif;
		if ($field === 'foreign_key'):
			$options['value'] = $id;
		endif;
		if ($field === 'key' && empty($this->data['Expander'][$key]['key'])):
			$options['value'] = $key;
		endif;
		if (!empty($keyOptions['label']) && $options['type'] !== 'hidden'):
			$options['label'] = $keyOptions['label'];
		endif;
		// sitex
		if (!empty($keyOptions['options']) && $options['type'] !== 'hidden'):
			$options['type'] = 'select';
			$options['options'] = $keyOptions['options'];
		endif;
		echo $this->Form->input($input, $options);
	endforeach;
endforeach;
