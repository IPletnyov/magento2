<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Ivan\News\Model\ResourceModel\News as NewsResource;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPoolInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNewsInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use Psr\Log\LoggerInterface;

/**
 * @inheritDoc
 */
class SaveNews implements SaveNewsInterface
{
    /**
     * @var NewsValidatorPoolInterface
     */
    private $newsValidatorPool;

    /**
     * @var NewsResource
     */
    private $newsResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param NewsValidatorPoolInterface $newsValidatorPool
     * @param NewsResource $newsResource
     * @param LoggerInterface $logger
     */
    public function __construct(
        NewsValidatorPoolInterface $newsValidatorPool,
        NewsResource $newsResource,
        LoggerInterface $logger
    ) {
        $this->newsValidatorPool = $newsValidatorPool;
        $this->newsResource = $newsResource;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(NewsInterface $news): NewsInterface
    {
        $validateResult = $this->newsValidatorPool->validate($news);
        if (!$validateResult->isValid()) {
            throw new ValidationException(__('Some news data invalid.'), null, 0, $validateResult);
        }

        try {
            $this->newsResource->save($news);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('News is not saved, please try again.'), $e);
        }

        return $news;
    }
}
