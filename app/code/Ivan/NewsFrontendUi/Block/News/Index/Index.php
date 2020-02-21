<?php

declare(strict_types=1);

namespace Ivan\NewsFrontendUi\Block\News\Index;

use Magento\Framework\View\Element\Template;

/**
 * Render all news list page.
 */
class Index extends Template
{
    /**
     * Return get list API URL path.
     *
     * @return string
     */
    public function getListUrlPath(): string
    {
        return 'rest/V1/news/list';
    }
}
