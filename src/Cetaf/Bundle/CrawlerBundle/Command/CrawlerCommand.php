<?php

namespace Cetaf\Bundle\CrawlerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;
use Cetaf\Bundle\CrawlerBundle\Entity\Shop;

class CrawlerCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('cetaf:crawl')
            ->setDescription('Crawl static web page of www.pagesjaunes.fr to retreive shop owner\'s in database')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while (true) {
			$dialog = $this->getHelperSet()->get('dialog');

			$name = $dialog->ask(
				$output,
				'Please enter the <info>http://www.pagesjaunes.fr</info> url that you want to <error>parse</error>: '
			);

			$this->parse($name);
		}
    }

	protected function parse($url)
	{
        $client = new Client();
        $crawler = $client->request('GET', $name);
        $pageNumber = $crawler->filter('div.navPagination.sc > ul.blockGauge.sc > li')->last()->text();

        $container = $crawler->filter('li.visitCard.withVisual.shadow');
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

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
    }
}
