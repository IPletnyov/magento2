<?php

declare(strict_types=1);

namespace Ivan\NewsFrontendUi\Block\News\Index;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Render all news.
 */
class Index extends Template
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param Context $context
     * @param NewsRepositoryInterface $newsRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        NewsRepositoryInterface $newsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->newsRepository = $newsRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Return search criteria result with all active news.
     *
     * @return NewsSearchResultInterface
     */
    public function getActiveNews(): NewsSearchResultInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(NewsInterface::FIELD_IS_ACTIVE, 1)
            ->create();

        return $this->newsRepository->getList($searchCriteria);
    }
}
