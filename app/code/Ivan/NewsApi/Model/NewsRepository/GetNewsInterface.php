<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

/**
 * Get news interface.
 */
interface GetNewsInterface
{
    /**
     * @param int $newsId
     * @return \Ivan\NewsApi\Api\Data\NewsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(int $newsId): \Ivan\NewsApi\Api\Data\NewsInterface;
}
