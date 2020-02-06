<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Get news list interface.
 */
interface GetNewsListInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return NewsSearchResultInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface;
}
