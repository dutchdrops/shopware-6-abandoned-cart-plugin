<?php

declare(strict_types=1);

namespace MailCampaigns\AbandonedCart\Exception;

use LogicException;
use Shopware\Core\Framework\Log\Package;

/**
 * @author Twan Haverkamp <twan@mailcampaigns.nl>
 */
#[Package('MailCampaigns\AbandonedCart')]
class MissingCartDataException extends LogicException
{
    public function __construct(string $requiredValue)
    {
        parent::__construct("Required value for '$requiredValue' is missing.");
    }
}
