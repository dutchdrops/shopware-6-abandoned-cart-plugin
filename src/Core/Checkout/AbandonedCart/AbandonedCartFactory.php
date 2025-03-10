<?php

declare(strict_types=1);

namespace MailCampaigns\AbandonedCart\Core\Checkout\AbandonedCart;

use MailCampaigns\AbandonedCart\Exception\InvalidCartDataException;
use MailCampaigns\AbandonedCart\Exception\MissingCartDataException;
use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Framework\Log\Package;

/**
 * @author Twan Haverkamp <twan@mailcampaigns.nl>
 */
#[Package('MailCampaigns\AbandonedCart')]
class AbandonedCartFactory
{
    /**
     * @var string[]
     */
    private static array $requiredValues = [
        'token',
        'price',
        'payload',
        'customer_id',
        'sales_channel_id',
    ];

    /**
     * @throws MissingCartDataException if a required value is missing.
     * @throws InvalidCartDataException if the given 'cart' value is not an instance of {@see Cart}.
     */
    public static function createFromArray(array $data): AbandonedCartEntity
    {
        self::validateData($data);

        $cart = unserialize($data['payload']);

        if (!$cart instanceof Cart) {
            throw new InvalidCartDataException('cart', Cart::class, $cart);
        }

        $entity = new AbandonedCartEntity();
        $entity->setCartToken($data['token']);
        $entity->setPrice((float)$data['price']);
        $entity->setLineItems($cart->getLineItems()->jsonSerialize());
        $entity->setCustomerId($data['customer_id']);
        $entity->setSalesChannelId($data['sales_channel_id']);

        return $entity;
    }

    /**
     * @throws MissingCartDataException if a required value is missing.
     */
    private static function validateData(array $data): void
    {
        foreach (self::$requiredValues as $requiredValue) {
            if (array_key_exists($requiredValue, $data) === false) {
                throw new MissingCartDataException($requiredValue);
            }
        }
    }
}
