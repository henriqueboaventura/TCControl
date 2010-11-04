<?php
class widgetFormJQueryDate extends sfWidgetFormInput
{
	/**
	 * Configures the current widget.
	 *
	 * Available options:
	 *
	 *  * image:   The image path to represent the widget (false by default)
	 *  * config:  A JavaScript array that configures the JQuery date widget
	 *  * culture: The user culture
	 *
	 * @param array $options     An array of options
	 * @param array $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetForm
	 */
	protected function configure($options = array(), $attributes = array())
	{
		$this->addOption('image', '\'/images/jquery-ui/datepicker_icon.gif\'');
		$this->addOption('config', '{}');
		$this->addOption('culture', '');

		parent::configure($options, $attributes);

		if ('en' == $this->getOption('culture'))
		{
			$this->setOption('culture', 'en');
		}
	}

	/**
	 * @param  string $name        The element name
	 * @param  string $value       The date displayed in this widget
	 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
	 * @param  array  $errors      An array of errors for the field
	 *
	 * @return string An HTML tag string
	 *
	 * @see sfWidgetForm
	 */
	public function render($name, $value = null, $attributes = array(), $errors = array())
	{
		$id = $this->generateId($name);

		$image = '';
		if (false !== $this->getOption('image'))
		{
			$image = sprintf(', buttonImage: %s, buttonImageOnly: true', $this->getOption('image'));
		}
		use_helper('Date');
		if($value != ''){
			//$value = format_date($value,'dd/MM/yyyy');
		}
		return parent::render($name, $value, $attributes, $errors).
		sprintf(<<<EOF
<script type="text/javascript">
    $("#%s").datepicker($.datepicker.regional['%s'],%s);
</script>
EOF
		, $id, $this->getOption('culture'), $this->getOption('config')
		);
	}
}