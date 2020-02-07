<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository\SaveNews;

/**
 * News validator pool interface.
 */
interface NewsValidatorPoolInterface
{
    /**
     * Return validation errors related to news validation.
     *
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return \Magento\Framework\Validation\ValidationResult
     */
    public function validate(
        \Ivan\NewsApi\Api\Data\NewsInterface $news
    ): \Magento\Framework\Validation\ValidationResult;
}
