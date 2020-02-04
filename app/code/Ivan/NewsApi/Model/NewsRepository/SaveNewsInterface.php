<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;

/**
 * Save news interface.
 */
interface SaveNewsInterface
{
    /**
     * @param NewsInterface $news
     * @return void
     * @throws ValidationException
     * @throws CouldNotSaveException
     */
    public function execute(NewsInterface $news): void;
}
