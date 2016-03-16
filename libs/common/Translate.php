<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/../language/I18N.php';
/**
 * 全局翻译方法
 * @param type $message
 * @param type $category
 * @param type $params
 * @param type $language
 * @return type
 */
function t($message, $category = "*", $params = array(), $language = "")
{
	return I18N::getInstance()->translate($category, $message, $params, $language);
}
/**
 * 全局翻译方法
 * @param type $message
 * @param type $category
 * @param type $params
 * @param type $language
 * @return type
 */
function __($message, $category = "*", $params = array(), $language = "")
{
	return I18N::getInstance()->translate($category, $message, $params, $language);
}
