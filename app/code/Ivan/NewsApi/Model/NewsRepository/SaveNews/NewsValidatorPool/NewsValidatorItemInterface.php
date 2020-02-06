<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPool;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Phrase;

/**
 * Interface of news validator item.
 */
interface NewsValidatorItemInterface
{
    /**
     * If news has errors return them.
     *
     * @param NewsInterface $news
     * @return Phrase[]
     */
    public function validate(NewsInterface $news): array;
}
