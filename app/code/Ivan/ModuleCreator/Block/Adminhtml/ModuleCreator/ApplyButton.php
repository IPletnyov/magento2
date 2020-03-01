<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Block\Adminhtml\ModuleCreator;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Apply selected configurations for create module components.
 */
class ApplyButton implements ButtonProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getButtonData()
    {
        return [
            'label' => __('Apply'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 10,
        ];
    }
}
