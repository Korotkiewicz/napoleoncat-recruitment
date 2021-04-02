<?php

declare(strict_types=1);
namespace NapoleonCat\Command;
use NapoleonCat\Infrastructure\QueueRepositoryInterface;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FeedScanner
 */
class FeedScanner extends Command
{
    protected static $defaultName = 'app:feed';
    private const PAGE_SOCIAL_ARGUMENT = 'page_social_id';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Feed Facebook Page & send to ZMQ');
        $this->addArgument(self::PAGE_SOCIAL_ARGUMENT, InputArgument::REQUIRED);
        $this->addOption('print','p', InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $pageSocialId = $input->getArgument(self::PAGE_SOCIAL_ARGUMENT);
            $printMode = $input->getOption('print');
            
            //@todo main recruitement task
        } catch(\Exception $e) {
            return $e->getCode();
        }

        return 0;
    }
}