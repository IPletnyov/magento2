<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Controller\Index;

use Ivan\ModuleCreator\Model\IsCreatorAvailable;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Module create main page.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var IsCreatorAvailable
     */
    private $isCreatorAvailable;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param IsCreatorAvailable $isCreatorAvailable
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        IsCreatorAvailable $isCreatorAvailable
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->isCreatorAvailable = $isCreatorAvailable;
    }

    /**
     * @return \Magento\Framework\View\Result\Page|void
     */
    public function execute()
    {
        if (!$this->isCreatorAvailable->execute()) {
            $this->_forward('noroute');
        }

        return $this->pageFactory->create();
    }
}
