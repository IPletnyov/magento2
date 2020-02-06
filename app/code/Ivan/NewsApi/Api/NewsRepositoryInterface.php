<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Api;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
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
     * @param int $newsId
     * @return NewsInterface
     * @throws NoSuchEntityException
     */
    public function get(int $newsId): NewsInterface;

    /**
     * Delete provided news.
     *
     * @param NewsInterface $news
     * @return void
     * @throws StateException
     */
    public function delete(NewsInterface $news): void;

    /**
     * Load news by provided id and delete.
     *
     * @param int $newsId
     * @return void
     * @throws NoSuchEntityException
     * @throws StateException
     */
    public function deleteById(int $newsId): void;

    /**
     * Get news list by search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return NewsSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface;
}
