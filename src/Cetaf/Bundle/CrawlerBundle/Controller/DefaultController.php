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
		$crawler = $client->request('GET', 'http://www.pagesjaunes.fr/annuaire/nantes-44/boulangeries-patisseries-artisans');

	 	$container = $crawler->filter('li.visitCard.withVisual.sc');
		$result ;
		for ($i = 0; $i < 20; $i++) {
			$result[$i]['nom'] = $container->filter('h2.titleMain > a > span')->text();	
			$result[$i]['adresse'] = $container->filter('div.localisationBlock > p')->text();	
			$result[$i]['telephone'] = $container->filter('div.bpInscTel > ul > li > strong > span')->text();	
			$container = $container->nextAll();
		}
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
