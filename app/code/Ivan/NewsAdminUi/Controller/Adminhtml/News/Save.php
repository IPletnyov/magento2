<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\NewsAdminUi\Model\SaveNewsWithData;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Save news action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsAdminUi::news';

    /**
     * @var SaveNewsWithData
     */
    private $saveNewsWithData;

    /**
     * @param Action\Context $context
     * @param SaveNewsWithData $saveNewsWithData
     */
    public function __construct(
        Action\Context $context,
        SaveNewsWithData $saveNewsWithData
    ) {
        parent::__construct($context);
        $this->saveNewsWithData = $saveNewsWithData;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $redirect = $this->resultRedirectFactory->create();
        $redirectParams = ['*/*/', []];
        try {
            $news = $this->saveNewsWithData->execute($this->getPostData());
            $this->messageManager->addSuccessMessage(__('You successfully saved the news.'));
            $redirectParams = $this->getRedirectPathParams($news);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong during saving the news.'));
        }

        return $redirect->setPath(...$redirectParams);
    }

    /**
     * Return save data.
     *
     * @return array
     */
    private function getPostData(): array
    {
        $postData = $this->getRequest()->getParams();
        $result = [
            'id' => $postData['id'] ?? null,
        ];
        $result = isset($postData['general']) ? array_merge($result, $postData['general']) : $result;

        return $result;
    }

    /**
     * Return redirect path by back param.
     *
     * @param NewsInterface $news
     * @return array
     */
    private function getRedirectPathParams(NewsInterface $news): array
    {
        $redirectParams = ['*/*/', []];

        if ($this->getRequest()->getParam('back') === 'edit') {
            $redirectParams = ['*/*/edit', ['id' => $news->getId(), '_current' => true]];
        } elseif ((bool)$this->getRequest()->getParam('redirect_to_new') === true) {
            $redirectParams = ['*/*/new', []];
        }

        return $redirectParams;
    }
}
