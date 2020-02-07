<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPool;

/**
 * Interface of news validator item.
 */
interface NewsValidatorItemInterface
{
    /**
     * If news has errors return them.
     *
     * @param \Ivan\NewsApi\Api\Data\NewsInterface $news
     * @return \Magento\Framework\Phrase[]
     */
    public function validate(\Ivan\NewsApi\Api\Data\NewsInterface $news): array;
}
