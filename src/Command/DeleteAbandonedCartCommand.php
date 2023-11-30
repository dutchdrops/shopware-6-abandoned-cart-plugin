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
    name: 'mailcampaigns:abandoned-cart:delete',
    description: 'Deletes "abandoned" carts without an existing reference.'
)]
#[Package('MailCampaigns\AbandonedCart')]
class DeleteAbandonedCartCommand extends Command
{
    public function __construct(
        private readonly AbandonedCartManager $manager,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cnt = $this->manager->cleanUp();

        $output->writeln("Deleted $cnt \"abandoned\" shopping carts.");

        return Command::SUCCESS;
    }
}
