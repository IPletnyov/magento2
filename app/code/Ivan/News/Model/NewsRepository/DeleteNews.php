<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository;

use Ivan\News\Model\ResourceModel\News as NewsResource;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Model\NewsRepository\DeleteNewsInterface;
use Magento\Framework\Exception\StateException;

/**
 * @inheritDoc
 */
class DeleteNews implements DeleteNewsInterface
{
    /**
     * @var NewsResource
     */
    private $newsResource;

    /**
     * @param NewsResource $newsResource
     */
    public function __construct(
        NewsResource $newsResource
    ) {
        $this->newsResource = $newsResource;
    }

    /**
     * @inheritDoc
     */
    public function execute(NewsInterface $news): void
    {
        try {
            $this->newsResource->delete($news);
        } catch (\Exception $e) {
            throw new StateException(__("News %1 could't removed", $news->getTitle()), $e);
        }
    }
}
