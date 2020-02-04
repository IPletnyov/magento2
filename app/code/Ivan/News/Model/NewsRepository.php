<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Ivan\NewsApi\Model\NewsRepository\GetNewsInterface;
use Ivan\NewsApi\Model\NewsRepository\GetNewsListInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNewsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @inheritDoc
 */
class NewsRepository implements NewsRepositoryInterface
{
    /**
     * @var SaveNewsInterface
     */
    private $saveNews;

    /**
     * @var GetNewsInterface
     */
    private $getNews;

    /**
     * @var GetNewsListInterface
     */
    private $getNewsList;

    /**
     * @param SaveNewsInterface $saveNews
     * @param GetNewsInterface $getNews
     * @param GetNewsListInterface $getNewsList
     */
    public function __construct(
        SaveNewsInterface $saveNews,
        GetNewsInterface $getNews,
        GetNewsListInterface $getNewsList
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
