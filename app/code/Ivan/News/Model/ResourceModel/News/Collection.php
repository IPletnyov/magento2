<?php

declare(strict_types=1);

namespace Ivan\News\Model\ResourceModel\News;

use Ivan\News\Model\News;
use Ivan\News\Model\ResourceModel\News as NewsResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * News collection.
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(News::class, NewsResource::class);
    }
}
