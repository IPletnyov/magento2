<?php

declare(strict_types=1);

namespace Ivan\NewsAmqp\Model;

use Magento\AsynchronousOperations\Api\Data\OperationInterface;

/**
 * Message queue consumer.
 */
class SaveNews
{
    /**
     * Process save news from queue.
     *
     * @param OperationInterface $operation
     * @return void
     */
    public function execute(OperationInterface $operation): void
    {
        //TODO Save news.
        $a = 1;
    }
}
