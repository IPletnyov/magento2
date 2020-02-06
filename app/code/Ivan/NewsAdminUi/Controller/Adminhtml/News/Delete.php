<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

/**
 * Delete news by id.
 */
class Delete extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsAdminUi::news';

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @param Action\Context $context
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(
        Action\Context $context,
        NewsRepositoryInterface $newsRepository
    ) {
        parent::__construct($context);
        $this->newsRepository = $newsRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $redirect = $this->resultRedirectFactory->create();
        $newsId = (int)$this->getRequest()->getParam('id');
        try {
            $this->newsRepository->deleteById($newsId);
            $this->messageManager->addSuccessMessage(__("You've deleted the news."));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__("News with ID %1 didn't find in system.", $newsId));
        } catch (StateException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong during process delete news.'));
        }

        return $redirect->setPath('*/*/');
    }
}
