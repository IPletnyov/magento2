<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Exception\StateException;

/**
 * Delete provided news.
 */
interface DeleteNewsInterface
{
    /**
     * @param NewsInterface $news
     * @return void
     * @throws StateException
     */
    public function execute(NewsInterface $news): void;
}
