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
        $output->writeln('Command result.');
    }
}
