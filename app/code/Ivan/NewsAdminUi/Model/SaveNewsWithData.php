<?php

declare(strict_types=1);

namespace Ivan\NewsAdminUi\Model;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Api\Data\NewsInterfaceFactory;
use Ivan\NewsApi\Api\NewsRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validation\ValidationException;

/**
 * Save news with data.
 */
class SaveNewsWithData
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var NewsInterfaceFactory
     */
    private $newsFactory;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param NewsRepositoryInterface $newsRepository
     * @param NewsInterfaceFactory $newsFactory
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        NewsRepositoryInterface $newsRepository,
        NewsInterfaceFactory $newsFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->newsRepository = $newsRepository;
        $this->newsFactory = $newsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param array $newsData
     * @return NewsInterface
     * @throws LocalizedException
     */
    public function execute(array $newsData): NewsInterface
    {
        $newsData = $this->normalizeNewsData($newsData);
        $news = null === $newsData[NewsInterface::FIELD_ID]
            ? $this->newsFactory->create() : $this->newsRepository->get($newsData[NewsInterface::FIELD_ID]);
        $this->dataObjectHelper->populateWithArray($news, $newsData, NewsInterface::class);

        try {
            $news = $this->newsRepository->save($news);
        } catch (ValidationException $e) {
            $this->throwExceptionByInvalidData($e);
        }

        return $news;
    }

    /**
     * Normalize provided data for put to news and save it.
     *
     * @param array $newsData
     * @return array
     */
    private function normalizeNewsData(array $newsData): array
    {
        $newsData[NewsInterface::FIELD_ID] = isset($newsData[NewsInterface::FIELD_ID])
            ? (int)$newsData[NewsInterface::FIELD_ID] : null;

        if (isset($newsData[NewsInterface::FIELD_TITLE])) {
            $newsData[NewsInterface::FIELD_TITLE] = trim($newsData[NewsInterface::FIELD_TITLE]);
        }

        if (isset($newsData[NewsInterface::FIELD_TEXT])) {
            $newsData[NewsInterface::FIELD_TEXT] = trim($newsData[NewsInterface::FIELD_TEXT]);
        }

        if (isset($newsData[NewsInterface::FIELD_IS_ACTIVE])) {
            $newsData[NewsInterface::FIELD_IS_ACTIVE] = (bool)$newsData[NewsInterface::FIELD_IS_ACTIVE];
        }

        return $newsData;
    }

    /**
     * Build exception message with validation exception messages and throw
     * LocalizedException with this messages.
     *
     * @param ValidationException $exception
     * @return void
     * @throws LocalizedException
     */
    private function throwExceptionByInvalidData(ValidationException $exception): void
    {
        $exceptionTextItems = [];

        foreach ($exception->getErrors() as $error) {
            $exceptionTextItems[] = $error->getMessage();
        }

        throw new LocalizedException(__('Some data is wrong. Errors: %1', implode(', ', $exceptionTextItems)));
    }
}
