<?php

declare(strict_types=1);

namespace NapoleonCat\Command;

use NapoleonCat\Infrastructure\QueueRepositoryInterface;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;
use NapoleonCat\Services\ATProviderInterface;
use NapoleonCat\Services\PageScanner;
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
    /**
     * @var PageScanner $pageScanner
     */
    private $pageScanner;

    /**
     * @var ATProviderInterface $atProvider
     */
    private $atProvider;

    public function __construct(PageScanner $pageScanner, ATProviderInterface $atProvider)
    {
        parent::__construct();

        $this->pageScanner = $pageScanner;
        $this->atProvider = $atProvider;
    }

    protected function configure()
    {
        $this->setDescription('Feed Facebook Page & send to ZMQ');
        $this->addArgument(self::PAGE_SOCIAL_ARGUMENT, InputArgument::REQUIRED);
        $this->addOption('print', 'p', InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pageSocialId = $input->getArgument(self::PAGE_SOCIAL_ARGUMENT);
        $printMode = $input->getOption('print');

        try {
            $pageAT = $this->atProvider->getPageAccessToken($pageSocialId);

            $collection = $this->pageScanner->scan($pageSocialId, $pageAT);

            if ($printMode) {
                $this->print($collection);
            }

            $this->send($collection);
        } catch (\Exception $e) {
            return $e->getCode();
        }

        return Command::SUCCESS;
    }

    /**
     * This method should be used to print debug info to cli
     * 
     * @param InboxItemCollection $collection
     * @param OutputInterface $output
     * @return void
     * @todo
     */
    private function print(InboxItemCollection $collection, OutputInterface $output): void
    {
        //@todo iterate collection and print result
    }

    /**
     * This method should be used to print debug info to cli
     * 
     * @param InboxItemCollection $collection
     * @return void
     * @todo
     */
    private function send(InboxItemCollection $collection): void
    {
        //@todo inject ZeroMQ
        //@todo push posts and comments to zero MQ
    }
}
