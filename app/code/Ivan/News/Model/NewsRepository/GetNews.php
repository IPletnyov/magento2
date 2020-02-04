<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Ivan\News\Model\ResourceModel\News as NewsResource;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Load news by ID.
 */
class GetNews
{
    /**
     * @var NewsInterfaceFactory
     */
    private $newsFactory;

    /**
     * @var NewsResource
     */
    private $newsResource;

    /**
     * @param NewsInterfaceFactory $newsFactory
     * @param NewsResource $newsResource
     */
    public function __construct(
        NewsInterfaceFactory $newsFactory,
        NewsResource $newsResource
    ) {
        $this->newsFactory = $newsFactory;
        $this->newsResource = $newsResource;
    }

    /**
     * @param int $newsId
     * @return NewsInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $newsId): NewsInterface
    {
        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $newsId, NewsInterface::FIELD_ID);

        if (null === $news->getId()) {
            throw new NoSuchEntityException(__('News not found by provided ID: "%id".', ['id' => $newsId]));
        }

        return $news;
    }
}
