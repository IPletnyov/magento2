<?php

declare(strict_types=1);

namespace Ivan\News\Model\NewsRepository\SaveNews;

use Ivan\NewsApi\Api\Data\NewsInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPool\NewsValidatorItemInterface;
use Ivan\NewsApi\Model\NewsRepository\SaveNews\NewsValidatorPoolInterface;
use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;

/**
 * @inheritDoc
 */
class NewsValidatorPool implements NewsValidatorPoolInterface
{
    /**
     * @var NewsValidatorItemInterface[]
     */
    private $validators;

    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @param ValidationResultFactory $validationResultFactory
     * @param array $validators
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        array $validators = []
    ) {
        $this->validationResultFactory = $validationResultFactory;
        $this->validators = $validators;
    }

    /**
     * @inheritDoc
     */
    public function validate(NewsInterface $news): ValidationResult
    {
        $errorsFromValidators = [];

        foreach ($this->validators as $validator) {
            if ($validator instanceof NewsValidatorItemInterface) {
                $errorsFromValidators = array_merge($errorsFromValidators, $validator->validate($news));
            }
        }

        return $this->validationResultFactory->create(['errors' => $errorsFromValidators]);
    }
}
