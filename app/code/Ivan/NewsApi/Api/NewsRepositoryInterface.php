<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Api;

/**
 * News repository.
 */
interface NewsRepositoryInterface
{
    /**
     * Save provided news.
     *
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return \Ivan\NewsApi\Api\Data\NewsInterface
     * @throws \Magento\Framework\Validation\ValidationException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Ivan\NewsApi\Api\Data\NewsInterface $news): \Ivan\NewsApi\Api\Data\NewsInterface;

    /**
     * Get news by id.
     *
     * @param int $newsId
     * @return \Ivan\NewsApi\Api\Data\NewsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $newsId): \Ivan\NewsApi\Api\Data\NewsInterface;

    /**
     * Delete provided news.
     *
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return void
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(\Ivan\NewsApi\Api\Data\NewsInterface $news): void;

    /**
     * Load news by provided id and delete.
     *
     * @param int $newsId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById(int $newsId): void;

    /**
     * Get news list by search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ivan\NewsApi\Api\Data\NewsSearchResultInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ): \Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
}
