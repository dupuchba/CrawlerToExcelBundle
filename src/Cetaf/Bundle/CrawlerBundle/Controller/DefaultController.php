<?php

namespace Cetaf\Bundle\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Cetaf\Bundle\CrawlerBundle\Entity\Shop;

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
        $em = $this->getDoctrine()->getManager();

        for ($j = 2; $j <= $pageNumber; $j++) {
            for ($i = 0; $i < 10; $i++) {
                $shop = new Shop();
                $shop->setShopName($container->filter('h2.titleMain > a > span')->text());
                $shop->setShopAdress($container->filter('div.dataCard.sc > div.localisationBlock > p')->text());
                $shop->setShopPhoneNumber($container->filter('div.dataCard.sc > div.contactBlock > ul > li > strong ')->text());
                $container = $container->nextAll();
            $em->persist($shop);
            $em->flush();
            }
        $crawler = $client->request('GET', 'http://www.pagesjaunes.fr/activites/boulangerie-patisserie-page_'.$j.'.html');
         $container = $crawler->filter('li.visitCard.withVisual.shadow');
        set_time_limit(20);
        }

        return array();
    }
}

//html/body/div[2]/div[2]/div/div[3]/div/div/p
////*[@id="containerSectionMain"]
//*[@id="containerSectionMain"]
//*[@id="containerSectionMain"]
//*[@id="lrVisitCard-1"]

//*[@id="ambiguiteQuoi"]/div[2]/div/div/div/div/div/p/a[1]
