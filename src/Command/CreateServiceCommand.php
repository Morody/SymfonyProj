<?php

namespace App\Command;

use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

#[AsCommand(
    name: 'service:create',
    description: 'Create new service',
)]
class CreateServiceCommand extends Command
{

    public function __construct(private Filesystem $filesystem)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
            $this->addArgument('serviceName', InputArgument::REQUIRED, 'Service name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $serviceName = $input->getArgument('serviceName');
        $fullPath = __DIR__.'/../../src/Services'.'/'.$serviceName;
        $io = new SymfonyStyle($input, $output);
        $nameService = $io->ask('Enter name service', $serviceName);

        $this->filesystem->dumpFile($fullPath,
            '<?php

namespace App\Services;

class '.$nameService.' {

}
');

        $output->writeln('Service created' . $input->getArgument('serviceName'));
        return Command::SUCCESS;
    }

}
