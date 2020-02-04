<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsAdminUi::news';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ivan_NewsAdminUi::news')
            ->addBreadcrumb(__('News'), __('List'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage news'));

        return $resultPage;
    }
}
