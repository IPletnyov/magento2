<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\NewsApi\Api\Data\NewsSearchResultInterface;
use Magento\Framework\Api\Search\SearchResult;

/**
 * News search result.
 */
class NewsSearchResult extends SearchResult implements NewsSearchResultInterface
{

}
