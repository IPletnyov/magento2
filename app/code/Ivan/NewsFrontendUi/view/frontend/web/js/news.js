define([
    'uiElement',
    'mage/storage'
], function (Component, storage) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Ivan_NewsFrontendUi/news',
            getListUrlPath: '',
            news: []
        },

        /**
         * @returns {Object}
         */
        initObservable: function () {
            this._super().observe([
                'news'
            ]);
            this.updateNews();

            return this;
        },

        /**
         * Update news from API request.
         */
        updateNews: function () {
            let $this = this;

            return storage.get(
                $this.getListUrlPath,
                false
            ).done(function (response) {
                $this.news(response.items);
            }).error(function (response) {

            });
        }
    });
});
