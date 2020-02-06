<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\NewsAdminUi\Model\SaveNewsWithData;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validation\ValidationException;

class GridItemEdit extends Action implements HttpPostActionInterface
{
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
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ivan_NewsAdminUi::news';

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $errorMessages = [];
        $itemsToSave = $this->getRequest()->getParam('items');

        if (null === $itemsToSave) {
            $errorMessages[] = __('Please specify POST data.');
        } else {
            foreach ($itemsToSave as $newsData) {
                try {
                    $this->saveNewsWithData->execute($newsData);
                } catch (CouldNotSaveException|NoSuchEntityException|LocalizedException $e) {
                    $errorMessages[] = $e->getMessage();
                }
            }
        }

        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData([
            'messages' => $errorMessages,
            'error' => count($errorMessages),
        ]);

        return $resultJson;
    }
}
