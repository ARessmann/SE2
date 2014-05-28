<?php
/**
 * helper class to handle list actions
 * 
 * @author Andreas Ressmann
 * 24.05.2014 
 */
class Core_Listhelper {
	/*
	 * get elemet by Id from List
	*/
	public static function getModelById ($elements, $id) {
		foreach ($elements as $element) {
			if ($element->getId () == $id)
				return $element;
		}
		return null;
	}
	
	/*
	 * Filter ignore List
	 */
	public static function getAnalysisIgnoreList ($filter) {
		$analysisIgnoreList = new Core_Model_AnalysisIgnore();
		$ret = array ();
		 
		$analysisIgnoreList = $analysisIgnoreList->loadAll();
		 
		foreach ($analysisIgnoreList as $ele) {
			if ($ele->getFilterId() == $filter || $ele->getFilterId() == 0){
				$ret[] = $ele->getTweetId();
			}
		}
		 
		return $ret;
	}
}