<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validation\ValidationException;

class GridItemEdit extends Action implements HttpPostActionInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param Action\Context $context
     * @param NewsRepositoryInterface $newsRepository
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Action\Context $context,
        NewsRepositoryInterface $newsRepository,
        DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context);
        $this->newsRepository = $newsRepository;
        $this->dataObjectHelper = $dataObjectHelper;
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
            foreach ($itemsToSave as $item) {
                try {
                    $news = $this->newsRepository->get((int)$item[NewsInterface::FIELD_ID]);
                    $this->dataObjectHelper->populateWithArray($news, $item, NewsInterface::class);
                    $this->newsRepository->save($news);
                } catch (CouldNotSaveException|NoSuchEntityException|ValidationException $e) {
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
