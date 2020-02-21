define([
    'uiElement',
    'mage/storage',
    'jquery'
], function (Component, storage, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Ivan_NewsFrontendUi/news',
            getListUrlPath: '',
            news: [],
            newsCache: {},
            currentPage: 1,
            pageSize: 5,
            totalCount: -1,
            isPreviousButtonVisible: false,
            isNextButtonVisible: false,
            searchCriteriaParams: {
                "searchCriteria": {
                    "filter_groups": [
                        {
                            "filters": [{
                                "field": "is_active",
                                "value": "1",
                                "condition_type": "eq"
                            }]
                        }
                    ],
                    "sort_orders": [{
                        "field": "title",
                        "direction": "DESC"
                    }]
                }
            }
        },

        /**
         * @returns {Object}
         */
        initObservable: function () {
            this._super().observe([
                'news',
                'currentPage',
                'pageSize',
                'isPreviousButtonVisible',
                'isNextButtonVisible'
            ]);
            this.updateNews();

            return this;
        },

        /**
         * Update news from API request.
         */
        updateNews: function () {
            if (this.newsCache[this.currentPage()] !== undefined) {
                this.news(this.newsCache[this.currentPage()]);
                this.updateButtonsVisibility();
                return;
            }

            let $this = this;
            this.searchCriteriaParams.searchCriteria['current_page'] = this.currentPage();
            this.searchCriteriaParams.searchCriteria['page_size'] = this.pageSize();
            let params = $.param(this.searchCriteriaParams);

            return storage.get(
                $this.getListUrlPath + '?' + params,
                false
            ).done(function (response) {
                $this.news(response.items);
                $this.newsCache[$this.currentPage()] = response.items;
                $this.totalCount = response['total_count'];
                $this.updateButtonsVisibility();
            }).error(function (response) {

            });
        },

        /**
         * Check is need to render news.
         */
        isNeedRenderNews: function () {
            return this.news().length > 0;
        },

        /**
         * Go to next page.
         */
        nextPage: function () {
            if (this.currentPage() < this.maxPage) {
                this.currentPage(this.currentPage() + 1);
                this.updateNews();
            }
        },

        /**
         * Go to previous page
         */
        previousPage: function () {
            if (this.currentPage() > 1) {
                this.currentPage(this.currentPage() - 1);
                this.updateNews();
            }
        },

        /**
         * Get max page count.
         */
        getMaxPage: function () {
            if (this.maxPage === undefined) {
                let newsCount = this.totalCount;
                this.maxPage = 0;

                while (newsCount > 0) {
                    this.maxPage++;
                    newsCount -= this.pageSize();
                }
            }

            return this.maxPage;
        },

        /**
         * Update buttons visibility.
         */
        updateButtonsVisibility: function () {
            if (this.getMaxPage() > this.currentPage()) {
                this.isNextButtonVisible(true);
            } else if (this.getMaxPage() <= this.currentPage()) {
                this.isNextButtonVisible(false);
            }
            this.isPreviousButtonVisible(!(this.currentPage() === 1));
        }
    });
});
