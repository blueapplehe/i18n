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

	/**
	 * 进行翻译，返回翻译结果
	 * @param type $category
	 * @param type $message
	 * @param type $params
	 * @param type $language
	 * @return type
	 */
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
    
	/**
	 * 对翻译结果进行格化处理，这里主要处理占位符,其他处理以后再实现
	 * @param type $message
	 * @param type $params
	 * @param type $language
	 * @return type
	 */
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

	/**
	 * 根据目录获取翻译处理器
	 * @param type $category
	 * @return \MessageSource
	 */
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
	 * 单例
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
