<?php

declare(strict_types=1);

namespace MailCampaigns\AbandonedCart\Command;

use MailCampaigns\AbandonedCart\Core\Checkout\AbandonedCart\AbandonedCartManager;
use Shopware\Core\Framework\Log\Package;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Twan Haverkamp <twan@mailcampaigns.nl>
 */
#[AsCommand(
    name: 'mailcampaigns:abandoned-cart:mark',
    description: 'Marks shopping carts older than the configured time as "abandoned".'
)]
#[Package('MailCampaigns\AbandonedCart')]
class MarkAbandonedCartCommand extends Command
{
    public function __construct(
        private readonly AbandonedCartManager $manager,
        string $name = null
    ) {

        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cnt = $this->manager->generate();

        $output->writeln("Marked $cnt shopping carts as \"abandoned\".");

        return Command::SUCCESS;
    }
}
