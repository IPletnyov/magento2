<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\News\Model\ResourceModel\News\Collection;
use Ivan\News\Model\ResourceModel\News\CollectionFactory;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Mass disable news action.
 */
class MassDisable extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsAdminUi::news';

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
            $this->newsMassActionProcessor->execute(NewsMassActionProcessor::PROCESS_TYPE_DISABLE);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. Please try again latter'));
        }
        $this->messageManager->addSuccessMessage(__('All selected news disabled successfully'));

        return $redirect;
    }
}
