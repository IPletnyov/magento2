<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Api;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validation\ValidationException;

/**
 * News repository.
 */
interface NewsRepositoryInterface
{
    /**
     * Save provided news.
     *
     * @param NewsInterface $news
     * @return NewsInterface
     * @throws ValidationException
     * @throws CouldNotSaveException
     */
    public function save(NewsInterface $news): NewsInterface;

    /**
     * Get news by id.
     *
     * @param int $id
     * @return NewsInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): NewsInterface;

    /**
     * Get news list by search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return NewsSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface;
}
