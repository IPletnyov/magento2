<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class Edit extends Action implements HttpGetActionInterface
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
     * @param Context $context
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(
        Context $context,
        NewsRepositoryInterface $newsRepository
    ) {
        parent::__construct($context);
        $this->newsRepository = $newsRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $newsId = (int)$this->getRequest()->getParam(NewsInterface::FIELD_ID);

        try {
            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $news = $this->newsRepository->get($newsId);
            $result->setActiveMenu('Ivan_NewsAdminUi::news')
                ->addBreadcrumb(__('Edit news'), __('Edit news'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit news: %title', ['title' => $news->getTitle()]));
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('News with ID: "%id" does not exist.', ['id' => $newsId])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
