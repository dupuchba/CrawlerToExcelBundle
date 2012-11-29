<?php

namespace Cetaf\Bundle\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.pagesjaunes.fr/activites/boulangerie-patisserie.html');
		$pageNumber = $crawler->filter('div.navPagination.sc > ul.blockGauge.sc > li')->last()->text();

	 	$container = $crawler->filter('li.visitCard.withVisual.shadow');
		$result = array();

		for ($j = 2; $j <= $pageNumber; $j++) {
			for ($i = 0; $i < 10; $i++) {
				$result[$j][$i]['nom'] = $container->filter('h2.titleMain > a > span')->text();	
				$result[$j][$i]['adresse'] = $container->filter('div.dataCard.sc > div.localisationBlock > p')->text();	
				$result[$j][$i]['telephone'] = $container->filter('div.dataCard.sc > div.contactBlock > ul > li > strong ')->text();	
				$container = $container->nextAll();
			}
		$crawler = $client->request('GET', 'http://www.pagesjaunes.fr/activites/boulangerie-patisserie-page_'.$j.'.html');
	 	$container = $crawler->filter('li.visitCard.withVisual.shadow');
		}
		var_dump($result);die();
		$link = $crawler->filter('div.navPagination.sc > ul.blockGauge.sc > li')->last()->text();
		var_dump($link);die();

		$crawler = $client->click($link);
	 	$container = $crawler->filter('li.visitCard.withVisual.sc');
		for ($i = 20; $i < 40; $i++) {
			$result[$i]['nom'] = $container->filter('h2.titleMain > a > span')->text();	
			$result[$i]['adresse'] = $container->filter('div.localisationBlock > p')->text();	
			$result[$i]['telephone'] = $container->filter('div.bpInscTel > ul > li > strong > span')->text();	
			$container = $container->nextAll();
		}		
		var_dump($result);die();

		$link = $crawler->selectLink('Page Suivante')->link();
		var_dump($link);die();
		$client->click($link);
		var_dump($client);die();	
		var_dump($result);
		die();
        return array();
    }
}

//html/body/div[2]/div[2]/div/div[3]/div/div/p
////*[@id="containerSectionMain"]
//*[@id="containerSectionMain"]
//*[@id="containerSectionMain"]
//*[@id="lrVisitCard-1"]

//*[@id="ambiguiteQuoi"]/div[2]/div/div/div/div/div/p/a[1]
