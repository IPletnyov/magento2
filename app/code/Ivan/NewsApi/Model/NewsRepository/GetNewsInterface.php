<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Get news interface.
 */
interface GetNewsInterface
{
    /**
     * @param int $newsId
     * @return NewsInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $newsId): NewsInterface;
}
