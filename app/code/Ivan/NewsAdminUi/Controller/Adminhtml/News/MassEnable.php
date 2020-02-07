<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Mass enable news action.
 */
class MassEnable extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsApi::news';

    /**
     * @var NewsMassActionProcessor
     */
    private $newsMassActionProcessor;

    /**
     * @param Action\Context $context
     * @param NewsMassActionProcessor $newsMassActionProcessor
     */
    public function __construct(
        Action\Context $context,
        NewsMassActionProcessor $newsMassActionProcessor
    ) {
        parent::__construct($context);
        $this->newsMassActionProcessor = $newsMassActionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('*/*/index');
        try {
            $this->newsMassActionProcessor->execute(NewsMassActionProcessor::PROCESS_TYPE_ENABLE);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. Please try again latter'));
        }
        $this->messageManager->addSuccessMessage(__('All selected news enabled successfully'));

        return $redirect;
    }
}
