<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Model;

use Ivan\ModuleCreator\Model\CreatorPool\CreatorConfigInterface;

/**
 * @inheritDoc
 */
class CreatorConfigPool implements CreatorConfigPoolInterface
{
    /**
     * @var CreatorConfigInterface[]
     */
    private $creatorsPool;

    /**
     * @param array $creatorsPool
     */
    public function __construct(
        array $creatorsPool = []
    ) {
        $this->creatorsPool = $creatorsPool;
    }

    /**
     * @inheritDoc
     */
    public function getCreators(): array
    {
        $creators = [];

        foreach ($this->creatorsPool as $creator) {
            if (!$creator instanceof CreatorConfigInterface) {
                CreatorConfigImplementationException::throwException(get_class($creator));
            }

            $creators[] = $creator;
        }

        return $creators;
    }
}
