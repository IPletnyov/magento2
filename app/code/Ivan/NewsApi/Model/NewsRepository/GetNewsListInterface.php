<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

/**
 * Get news list interface.
 */
interface GetNewsListInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ivan\NewsApi\Api\Data\NewsSearchResultInterface
     */
    public function execute(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ): \Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
}
