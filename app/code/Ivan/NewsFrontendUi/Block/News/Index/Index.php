<?php

declare(strict_types=1);

namespace Ivan\NewsFrontendUi\Block\News\Index;

use Magento\Framework\View\Element\Template;

/**
 * Render all news.
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

    /**
     * Build search criteria query for get all active news.
     *
     * @return string
     */
    private function getSearchCriteriaQuery(): string
    {
        return http_build_query([
            'searchCriteria' => [
                'filter_groups' => [
                    [
                        'filters' => [
                            [
                                'field' => 'is_active',
                                'value' => '1',
                                'condition_type' => 'eq',
                            ],
                        ],
                    ],
                ],
                'sort_orders' => [
                    [
                        'field' => 'title',
                        'direction' => 'DESC',
                    ],
                ],
                'current_page' => 1,
                'page_size' => 10,
            ],
        ]);
    }
}
