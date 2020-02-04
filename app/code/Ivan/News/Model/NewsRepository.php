<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\News\Model\NewsRepository\GetNewsList;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @inheritDoc
 */
class NewsRepository implements NewsRepositoryInterface
{
    /**
     * @var GetNewsList
     */
    private $getNewsList;

    /**
     * @param GetNewsList $getNewsList
     */
    public function __construct(
        GetNewsList $getNewsList
    ) {
        $this->getNewsList = $getNewsList;
    }


    /**
     * @inheritDoc
     */
    public function save(NewsInterface $news): NewsInterface
    {
        // TODO: Implement save() method.
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): NewsInterface
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface
    {
        return $this->getNewsList->execute($searchCriteria);
    }
}
