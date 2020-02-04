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
     * @return NewsInterface[]
     */
    public function getItems();

    /**
     * Set news list
     *
     * @param NewsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
