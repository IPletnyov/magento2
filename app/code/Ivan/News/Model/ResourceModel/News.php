<?php

declare(strict_types=1);

namespace Ivan\News\Model\ResourceModel;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * News resource model.
 */
class News extends AbstractDb
{
    /**
     * News table name.
     */
    public const NEWS_TABLE_NAME = 'news';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::NEWS_TABLE_NAME, NewsInterface::FIELD_ID);
    }
}
