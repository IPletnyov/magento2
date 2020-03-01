<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Model;

use Ivan\ModuleCreator\Model\CreatorPool\CreatorConfigInterface;

/**
 * Creator config must implement \Ivan\ModuleCreator\Model\CreatorPool\CreatorConfigInterface.
 */
class CreatorConfigImplementationException extends \Exception
{
    /**
     * Throw exception with default message.
     *
     * @param string $wrongClass
     * @throws CreatorConfigImplementationException
     */
    public static function throwException(string $wrongClass): void
    {
        throw new self(
            __(
                'Creator config must implement %1. Please check your %2 class.',
                CreatorConfigInterface::class,
                $wrongClass
            )
        );
    }
}
