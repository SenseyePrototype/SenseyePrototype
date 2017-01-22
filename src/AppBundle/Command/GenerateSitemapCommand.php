<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSitemapCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('senseye:generate:sitemap');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $root = dirname($this->getContainer()->getParameter('kernel.root_dir'));

        $xml = new \DOMDocument('1.0', 'UTF-8');

        $setXml = $xml->createElement('urlset');

        $setXml->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $available = $this->getContainer()->get('senseye.profile.available.criteria.repository')->get();

        $urls = [
            'http://senseye.com.ua/developers'
        ];

        $cities = $available->getMultiMap()['cities'];
        foreach ($cities as $city) {
            $urls[] = "http://senseye.com.ua/developers/{$city['alias']}";
        }

        foreach ($urls as $url) {
            $urlXml = $xml->createElement('url');
            $locXml = $xml->createElement('loc', $url);
            $urlXml->appendChild($locXml);
            $setXml->appendChild($urlXml);
        }

        $xml->appendChild($setXml);
        $xml->formatOutput = true;
        $xml->preserveWhiteSpace = false;
        $xml->save($root . '/web/sitemap.xml');
    }
}
