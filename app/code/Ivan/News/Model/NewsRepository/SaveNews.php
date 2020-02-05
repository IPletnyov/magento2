<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Exception;
use Ivan\News\Model\ResourceModel\News as NewsResource;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNewsInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * @inheritDoc
 */
class SaveNews implements SaveNewsInterface
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
     * @inheritDoc
     */
    public function execute(NewsInterface $news): NewsInterface
    {
        //TODO Add validation before save.

        try {
            $this->newsResource->save($news);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('News is not saved, please try again.'), $e);
        }

        return $news;
    }
}
