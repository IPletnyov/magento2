<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\State;

/**
 * News grid page.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var State
     */
    private $state;

    /**
     * @param Action\Context $context
     * @param State $state
     */
    public function __construct(
        Action\Context $context,
        State $state
    ) {
        parent::__construct($context);
        $this->state = $state;
    }

    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ivan_ModuleCreator::index')
            && $this->state->getMode() === State::MODE_DEVELOPER;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ivan_ModuleCreator::index');
        $resultPage->getConfig()->getTitle()->prepend(__('Create module components'));

        return $resultPage;
    }
}
