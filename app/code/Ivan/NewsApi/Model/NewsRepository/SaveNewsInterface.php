<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

/**
 * Save news interface.
 */
interface SaveNewsInterface
{
    /**
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return \Ivan\NewsApi\Api\Data\NewsInterface
     * @throws \Magento\Framework\Validation\ValidationException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(\Ivan\NewsApi\Api\Data\NewsInterface $news): \Ivan\NewsApi\Api\Data\NewsInterface;
}
