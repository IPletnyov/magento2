<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository\SaveNews;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Validation\ValidationResult;

/**
 * News validator pool interface.
 */
interface NewsValidatorPoolInterface
{
    /**
     * Return validation errors related to news validation.
     *
     * @param NewsInterface $news
     * @return ValidationResult
     */
    public function validate(NewsInterface $news): ValidationResult;
}
