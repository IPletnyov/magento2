<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Exception;
use Ivan\News\Model\ResourceModel\News as NewsResource;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save provided news.
 */
class SaveNews
{
    /**
     * @var NewsResource
     */
    private $newsResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param NewsResource $newsResource
     * @param LoggerInterface $logger
     */
    public function __construct(
        NewsResource $newsResource,
        LoggerInterface $logger
    ) {
        $this->newsResource = $newsResource;
        $this->logger = $logger;
    }

    /**
     * @param NewsInterface $news
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(NewsInterface $news): void
    {
        //TODO Add validation before save.

        try {
            $this->newsResource->save($news);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('News is not saved, please try again.'), $e);
        }
    }
}
