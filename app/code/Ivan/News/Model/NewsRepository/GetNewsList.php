<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Ivan\News\Model\ResourceModel\News\CollectionFactory;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Perform search of news by search criteria.
 */
class GetNewsList
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var NewsSearchResultInterfaceFactory
     */
    private $newsSearchResultFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $collectionFactory
     * @param NewsSearchResultInterfaceFactory $newsSearchResultFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        NewsSearchResultInterfaceFactory $newsSearchResultFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->newsSearchResultFactory = $newsSearchResultFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return NewsSearchResultInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult = $this->newsSearchResultFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
