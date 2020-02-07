<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Controller\Adminhtml\News;

use Ivan\News\Model\ResourceModel\News\CollectionFactory;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Mass delete, enable or disable news processor
 */
class NewsMassActionProcessor
{
    /**
     * Delete news process name.
     */
    public const PROCESS_TYPE_DELETE = 'delete';

    /**
     * Enable news process name.
     */
    public const PROCESS_TYPE_ENABLE = 'enable';

    /**
     * Disable news process name.
     */
    public const PROCESS_TYPE_DISABLE = 'disable';

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        NewsRepositoryInterface $newsRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->newsRepository = $newsRepository;
    }

    /**
     * Process all collection items by provided process type.
     *
     * @param string $processType
     * @return void
     */
    public function execute(string $processType): void
    {
        $newsCollection = $this->collectionFactory->create();
        $this->filter->getCollection($newsCollection);
        /** @var NewsInterface $news */
        foreach ($newsCollection as $news) {
            if ($processType === self::PROCESS_TYPE_ENABLE) {
                $news->setIsActive(true);
            } elseif ($processType === self::PROCESS_TYPE_DISABLE) {
                $news->setIsActive(false);
            } elseif ($processType === self::PROCESS_TYPE_DELETE) {
                $this->newsRepository->delete($news);
                continue;
            }
            $this->newsRepository->save($news);
        }
    }
}
