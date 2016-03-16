<?php
require_once 'MessageSource.php';
class DbMessageSource extends MessageSource
{
    const CACHE_KEY_PREFIX = 'DbMessageSource';

    public $db = 'db';
	
    public $cache = 'cache';

	
    public $sourceMessageTable = 'source_message';

    public $messageTable = 'message';

	
    public $cachingDuration = 0;

    public $enableCaching = false;


    public function init()
    {
//        $this->db = Instance::ensure($this->db, Connection::className());
//        if ($this->enableCaching) {
//            $this->cache = Instance::ensure($this->cache, Cache::className());
//        }
    }
	
	/**
	 * 
	 * @param type $category
	 * @param type $language
	 * @return type
	 */
    protected function loadMessages($category, $language)
    {
//        if ($this->enableCaching) {
//            $key = [
//                __CLASS__,
//                $category,
//                $language,
//            ];
//            $messages = $this->cache->get($key);
//            if ($messages === false) {
//                $messages = $this->loadMessagesFromDb($category, $language);
//                $this->cache->set($key, $messages, $this->cachingDuration);
//            }
//
//            return $messages;
//        } else {
//            return $this->loadMessagesFromDb($category, $language);
//        }
    }

	/**
	 * 从数据库中加载翻译数组
	 * @param type $category
	 * @param type $language
	 * @return type
	 */
    protected function loadMessagesFromDb($category, $language)
    {
//        $mainQuery = new Query();
//        $mainQuery->select(['t1.message message', 't2.translation translation'])
//            ->from(["$this->sourceMessageTable t1", "$this->messageTable t2"])
//            ->where('t1.id = t2.id AND t1.category = :category AND t2.language = :language')
//            ->params([':category' => $category, ':language' => $language]);
//
//        $fallbackLanguage = substr($language, 0, 2);
//        if ($fallbackLanguage != $language) {
//            $fallbackQuery = new Query();
//            $fallbackQuery->select(['t1.message message', 't2.translation translation'])
//                ->from(["$this->sourceMessageTable t1", "$this->messageTable t2"])
//                ->where('t1.id = t2.id AND t1.category = :category AND t2.language = :fallbackLanguage')
//                ->andWhere("t2.id NOT IN (SELECT id FROM $this->messageTable WHERE language = :language)")
//                ->params([':category' => $category, ':language' => $language, ':fallbackLanguage' => $fallbackLanguage]);
//
//            $mainQuery->union($fallbackQuery, true);
//        }
//
//        $messages = $mainQuery->createCommand($this->db)->queryAll();
//
//        return ArrayHelper::map($messages, 'message', 'translation');
    }
}
