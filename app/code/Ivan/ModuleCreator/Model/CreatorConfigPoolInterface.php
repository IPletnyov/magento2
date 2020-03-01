<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Model;

use Ivan\ModuleCreator\Model\CreatorPool\CreatorConfigInterface;

/**
 * Pool of creator configurations which need render.
 */
interface CreatorConfigPoolInterface
{
    /**
     * All creator config items.
     *
     * @return CreatorConfigInterface[]
     * @throws CreatorConfigImplementationException
     */
    public function getCreators(): array;
}
