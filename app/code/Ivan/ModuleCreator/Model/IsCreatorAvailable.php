<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Model;

use Magento\Framework\App\State;

/**
 * Check create module availability.
 */
class IsCreatorAvailable
{
    /**
     * @var State
     */
    private $state;

    /**
     * @param State $state
     */
    public function __construct(
        State $state
    ) {
        $this->state = $state;
    }

    /**
     * Check that magento mode equals to developer.
     *
     * @return bool
     */
    public function execute(): bool
    {
        return $this->state->getMode() === State::MODE_DEVELOPER;
    }
}
