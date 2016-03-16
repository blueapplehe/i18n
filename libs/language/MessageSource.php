<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MessageSource
{

	private $_messages = array();

	/**
	 * 加载翻译数组接口
	 * @param type $category
	 * @param type $language
	 * @return type
	 */
	protected function loadMessages($category, $language)
	{
		return array();
	}
   
	/**
	 * 进行翻译，返回翻译结果
	 * @param type $category
	 * @param type $message
	 * @param type $language
	 * @return type
	 */
	public function translate($category, $message, $language)
	{
		return $this->translateMessage($category, $message, $language);
	}
	
	/**
	 * 进行翻译，返回翻译结果
	 * @param type $category
	 * @param type $message
	 * @param type $language
	 * @return type
	 * 
	 */

	protected function translateMessage($category, $message, $language)
	{
		$key = $language . '/' . $category;
		if (!isset($this->_messages[$key])) {
			$this->_messages[$key] = $this->loadMessages($category, $language);
		}
		if (isset($this->_messages[$key][$message]) && $this->_messages[$key][$message] !== '') {
			return $this->_messages[$key][$message];
		} else {
			return $message;
		}
	}

}
