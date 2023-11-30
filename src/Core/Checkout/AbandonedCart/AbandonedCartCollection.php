<?php

declare(strict_types=1);

namespace MailCampaigns\AbandonedCart\Core\Checkout\AbandonedCart;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\Log\Package;

/**
 * @author Twan Haverkamp <twan@mailcampaigns.nl>
 *
 * @extends EntityCollection<AbandonedCartEntity>
 */
#[Package('MailCampaigns\AbandonedCart')]
class AbandonedCartCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return AbandonedCartEntity::class;
    }
}
