<?php

require_once 'MessageSource.php';

class PhpMessageSource extends MessageSource
{

	public $basePath = '';
	public $fileMap;

	public function __construct()
	{
		//语言包目录
		$this->basePath = rtrim(BASE_PATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . "locale" . DIRECTORY_SEPARATOR;
	}

	
	/**
	 * 加载翻译数组
	 * @param type $category
	 * @param type $language
	 * @return type
	 */
	protected function loadMessages($category, $language)
	{
		$messageFile = $this->getMessageFilePath($category, $language);
		$messages = $this->loadMessagesFromFile($messageFile);
		return (array) $messages;
	}
	
    /**
	 * 扫描语言目录下所有翻译文件
	 * @param type $dir
	 * @return string
	 */
	function scan_all($dir)
	{
		$temp = scandir($dir);
		$files = array();
		if (is_array($temp) && count($temp) > 2) {
			array_shift($temp);
			array_shift($temp);
			foreach ($temp as $v)
			{
				$cur_dir = rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $v;
				if (is_dir($cur_dir)) {
					$arr = $this->scan_all($cur_dir);
					$files = array_merge($files, $arr);
				} else if (is_file($cur_dir)) {
					$cur_arr=explode('.', $cur_dir);
					if (end($cur_arr) == "php") {
						$files[] = rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $v;
					}
				} else {
					die("file error");
				}
			}
		}
		return $files;
	}

	/**
	 * 获取要加载的文件
	 * @param type $category
	 * @param type $language
	 * @return string
	 */
	protected function getMessageFilePath($category, $language)
	{
		$messageFile = $this->basePath . $language . DIRECTORY_SEPARATOR;
		$map = array();
		if (isset($map[$category])) {
			$messageFile.=$map[$category];
		} else if ($category == "*") {
			$messageFile = $this->scan_all($messageFile);
			$last_include = array();
			foreach ($messageFile as $key => $value)
			{
				if (strstr($value, "common.php")) {
					$last_include[] = $value;
					unset($messageFile[$key]);
				}
				$messageFile = array_merge($messageFile, $last_include);
			}
		} else if ($category != "") {
			$messageFile.=$category . ".php";
		} else {
			$messageFile.="common.php";
		}
		return $messageFile;
	}

	/**
	 * 从文件中读取翻译数组
	 * @param type $messageFile
	 * @return null|array
	 */
	protected function loadMessagesFromFile($messageFile)
	{
		if (is_array($messageFile)) {
			$messages = array();
			foreach ($messageFile as $one)
			{
				$arr = include($one);
				if (is_array($arr)) {
					$messages = array_merge($messages, $arr);
				}
			}
			return $messages;
		} else if (is_file($messageFile)) {
			$messages = include($messageFile);
			if (!is_array($messages)) {
				$messages = array();
			}
			return $messages;
		} else {
			return null;
		}
	}

}
