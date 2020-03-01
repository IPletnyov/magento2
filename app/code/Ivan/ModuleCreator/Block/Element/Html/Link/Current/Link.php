<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Block\Element\Html\Link\Current;

use Ivan\ModuleCreator\Model\IsCreatorAvailable;
use Magento\Framework\App\DefaultPathInterface;
use Magento\Framework\View\Element\Html\Link\Current;
use Magento\Framework\View\Element\Template\Context;

/**
 * Link to create module page.
 */
class Link extends Current
{
    /**
     * @var IsCreatorAvailable
     */
    private $isCreatorAvailable;

    /**
     * @param Context $context
     * @param DefaultPathInterface $defaultPath
     * @param IsCreatorAvailable $isCreatorAvailable
     * @param array $data
     */
    public function __construct(
        Context $context,
        DefaultPathInterface $defaultPath,
        IsCreatorAvailable $isCreatorAvailable,
        array $data = []
    ) {
        parent::__construct($context, $defaultPath, $data);
        $this->isCreatorAvailable = $isCreatorAvailable;
    }

    /**
     * Will render link if it's available.
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->isCreatorAvailable->execute()) {
            return '';
        }

        return parent::_toHtml();
    }
}
