define([
    'uiElement'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Ivan_ModuleCreator/module_creator',
            noCreatorsMessage: "",
            creatorsInitData: []
        },

        /**
         * @returns {Object}
         */
        initObservable: function () {
            this._super().observe([
                'noCreatorsMessage',
                'creatorsInitData'
            ]);

            return this;
        },

        /**
         * Check that creators founded in system.
         */
        isCreatorsFoundInSystem: function () {
            return this.creatorsInitData().length !== 0
        }
    });
});
