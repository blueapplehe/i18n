<?php

require_once 'PhpMessageSource.php';

class I18N
{

	public $translations;
	private $language;
	//private $_messageFormatter;

	public function __construct()
	{
		if (defined("LANG")) {
			$this->setLanguage(LANG);
		} else {
			$this->setLanguage("zh_CN");
		}
	}

	public function setLanguage($language)
	{
		$this->language = $language;
	}

	public function translate($category, $message, $params, $language)
	{
		if ($language == "") {
			$language = $this->language;
		}
		$messageSource = $this->getMessageSource($category);
		$translation = $messageSource->translate($category, $message, $language);

		return $this->format($translation, $params, $language);
		return $translation;
	}

	public function format($message, $params, $language)
	{
		$params = (array) $params;
		if ($params === array()) {
			return $message;
		}
		$p = array();
		foreach ($params as $name => $value)
		{
			$p['{' . $name . '}'] = $value;
		}

		return strtr($message, $p);
	}

	public function getMessageSource($category)
	{
		if (isset($this->translations[$category])) {
			$source = $this->translations[$category];
			if ($source instanceof MessageSource) {
				return $source;
			} else {
				die("error messagesource");
			}
		} else {
			$source = new PhpMessageSource();
			return $this->translations[$category] = $source;
		}
	}

	static protected $instance;

	/**
	 * 
	 * @return I18N
	 */
	static function getInstance()
	{
		if (self::$instance == NULL) {
			self::$instance = new I18N();
		}
		return self::$instance;
	}

}
