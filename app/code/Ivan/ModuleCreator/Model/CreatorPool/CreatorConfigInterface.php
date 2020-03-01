<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Model\CreatorPool;

/**
 * Contain all config data which need for render creator on frontend.
 */
interface CreatorConfigInterface
{
    /**
     * Unique creator code for identify related creator processor.
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Creator config data.
     *
     * @return array
     */
    public function getConfigData(): array;
}
