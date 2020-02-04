<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\News\Model\NewsRepository\GetNews;
use Ivan\News\Model\NewsRepository\GetNewsList;
use Ivan\News\Model\NewsRepository\SaveNews;
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
     * @var SaveNews
     */
    private $saveNews;

    /**
     * @var GetNews
     */
    private $getNews;

    /**
     * @param SaveNews $saveNews
     * @param GetNews $getNews
     * @param GetNewsList $getNewsList
     */
    public function __construct(
        SaveNews $saveNews,
        GetNews $getNews,
        GetNewsList $getNewsList
    ) {
        $this->saveNews = $saveNews;
        $this->getNews = $getNews;
        $this->getNewsList = $getNewsList;
    }

    /**
     * @inheritDoc
     */
    public function save(NewsInterface $news): void
    {
        $this->saveNews->execute($news);
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): NewsInterface
    {
        return $this->getNews->execute($id);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface
    {
        return $this->getNewsList->execute($searchCriteria);
    }
}
