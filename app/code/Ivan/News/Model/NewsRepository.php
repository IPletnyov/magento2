<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Ivan\NewsApi\Model\NewsRepository\DeleteNewsInterface;
use Ivan\NewsApi\Model\NewsRepository\GetNewsInterface;
use Ivan\NewsApi\Model\NewsRepository\GetNewsListInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNewsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

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
     * @var DeleteNewsInterface
     */
    private $deleteNews;

    /**
     * @var GetNewsListInterface
     */
    private $getNewsList;

    /**
     * @param SaveNewsInterface $saveNews
     * @param GetNewsInterface $getNews
     * @param DeleteNewsInterface $deleteNews
     * @param GetNewsListInterface $getNewsList
     */
    public function __construct(
        SaveNewsInterface $saveNews,
        GetNewsInterface $getNews,
        DeleteNewsInterface $deleteNews,
        GetNewsListInterface $getNewsList
    ) {
        $this->saveNews = $saveNews;
        $this->getNews = $getNews;
        $this->getNewsList = $getNewsList;
        $this->deleteNews = $deleteNews;
    }

    /**
     * @inheritDoc
     */
    public function save(NewsInterface $news): NewsInterface
    {
        return $this->saveNews->execute($news);
    }

    /**
     * @inheritDoc
     */
    public function get(int $newsId): NewsInterface
    {
        return $this->getNews->execute($newsId);
    }

    /**
     * @inheritDoc
     */
    public function delete(NewsInterface $news): void
    {
        $this->deleteNews->execute($news);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $newsId): void
    {
        $news = $this->get($newsId);
        $this->delete($news);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NewsSearchResultInterface
    {
        return $this->getNewsList->execute($searchCriteria);
    }
}
