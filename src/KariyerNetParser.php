<?php
namespace KariyerNetParser;
use DiDom\Document;

class KariyerNetParser {
	private $listingPage = '';
	private $result = array();
	private $baseUrl = 'http://kariyer.net';

	public function setListingPage($listingPage){
		$this->listingPage = $listingPage;
	}
	public function getListingPageJobs(){
		if($this->listingPage){
			$page = new Document($this->listingPage, true);
			$ads = $page->find('table#tblIlanlar > tr#trIlanno');
			if(!empty($ads)){
				foreach($ads as $ad) {
					$result[] = array(
						'title' => $ad->child(2)->text(),
				    	'link' => $this->baseUrl.$ad->child(2)->find('a')[0]->attr('href'),
				    	'location' => $ad->child(4)->text(),
						'company' => $ad->child(6)->text()
					);
				}
				return $result;
			}else{
				throw new \Exception("No result found", 1);
			}
		}else{
			throw new \Exception("Listing page has to be set", 1);

		}
	}

}