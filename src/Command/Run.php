<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace PPP\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Run extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->setName('run')
            ->setDescription('preproccess');
    }


    public function run(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting...');
    }
}
