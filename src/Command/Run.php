<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace PPP\Command;

use FilesystemIterator;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Run extends \Symfony\Component\Console\Command\Command
{
    public function configure()
    {
        $this
            ->setName('run')
            ->setDescription('preproccess')
            ->addArgument('source', InputArgument::REQUIRED, 'Path to file or directory', '.');
    }


    public function run(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting...');

        if (extension_loaded('xdebug')) {
            $output->writeln('<error>It is highly recommended to disable the XDebug extension before invoking this command.</error>');
        }

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP5, new \PhpParser\Lexer\Emulative(
            array(
                'usedAttributes' => array(
                    'comments',
                    'startLine',
                    'endLine',
                    'startTokenPos',
                    'endTokenPos'
                )
            )
        ));

        $source = $input->getArgument('source');
        if (is_dir($source)) {
            $directoryIterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS)
            );

            /** @var SplFileInfo $file */
            foreach ($directoryIterator as $file) {
                if ($file->getExtension() != 'php') {
                    continue;
                }

                $this->fetchFile($file->getPathname(), $parser);
            }
        } elseif (is_file($source)) {
            $this->fetchFile($source, $parser);
        }
    }

    /**
     * @param string $source
     * @param Parser $parser
     */
    public function fetchFile($source, Parser $parser)
    {
        $astTraverser = new \PhpParser\NodeTraverser();
    }
}
