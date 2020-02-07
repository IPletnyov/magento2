<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * News search result interface.
 */
interface NewsSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get news list
     *
     * @return \Ivan\NewsApi\Api\Data\NewsInterface[]
     */
    public function getItems();

    /**
     * Set news list
     *
     * @param \Ivan\NewsApi\Api\Data\NewsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
