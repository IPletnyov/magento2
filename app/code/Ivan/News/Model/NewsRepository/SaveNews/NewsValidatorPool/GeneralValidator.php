<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository\SaveNews\NewsValidatorPool;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPool\NewsValidatorItemInterface;

/**
 * @inheritDoc
 */
class GeneralValidator implements NewsValidatorItemInterface
{
    /**
     * @inheritDoc
     */
    public function validate(NewsInterface $news): array
    {
        $errors = [];

        if (!\Zend_Validate::is($news->getTitle(), 'NotEmpty')) {
            $errors[] = __(
                '"%fieldName" is required. Enter and try again.',
                ['fieldName' => NewsInterface::FIELD_TITLE]
            );
        }

        if (!\Zend_Validate::is($news->getText(), 'NotEmpty')) {
            $errors[] = __(
                '"%fieldName" is required. Enter and try again.',
                ['fieldName' => NewsInterface::FIELD_TEXT]
            );
        }

        return $errors;
    }
}
