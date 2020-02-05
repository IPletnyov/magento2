<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Ui\Component\Control\News;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

class SplitSaveButton implements ButtonProviderInterface
{
    /**
     * Back param for save action.
     */
    public const BACK_SAVE_AND_CLOSE = 'save_and_close';
    public const BACK_SAVE_AND_CONTINUE = 'save_and_continue';
    public const BACK_SAVE_AND_NEW = 'save_and_new';

    /**
     * @inheritDoc
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'news_news_form.news_news_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => self::BACK_SAVE_AND_CLOSE,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
        ];
    }

    /**
     * Retrieve options
     *
     * @return array
     */
    private function getOptions()
    {
        return [
            [
                'label' => __('Save & Continue'),
                'id_hard' => 'save_and_continue',
                'data_attribute' => [
                    'mage-init' => [
                        'buttonAdapter' => [
                            'actions' => [
                                [
                                    'targetName' => 'news_news_form.news_news_form',
                                    'actionName' => 'save',
                                    'params' => [
                                        true,
                                        [
                                            'back' => self::BACK_SAVE_AND_CONTINUE
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id_hard' => 'save_and_new',
                'label' => __('Save & New'),
                'data_attribute' => [
                    'mage-init' => [
                        'buttonAdapter' => [
                            'actions' => [
                                [
                                    'targetName' => 'news_news_form.news_news_form',
                                    'actionName' => 'save',
                                    'params' => [
                                        true,
                                        [
                                            'back' => self::BACK_SAVE_AND_NEW
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
