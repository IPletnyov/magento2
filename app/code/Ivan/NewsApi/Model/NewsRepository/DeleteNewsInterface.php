<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

/**
 * Delete provided news.
 */
interface DeleteNewsInterface
{
    /**
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return void
     * @throws \Magento\Framework\Exception\StateException
     */
    public function execute(\Ivan\NewsApi\Api\Data\NewsInterface $news): void;
}
