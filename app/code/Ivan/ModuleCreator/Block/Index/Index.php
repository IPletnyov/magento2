<?php

declare(strict_types=1);

namespace Ivan\ModuleCreator\Block\Index;

use Ivan\ModuleCreator\Model\CreatorConfigImplementationException;
use Ivan\ModuleCreator\Model\CreatorConfigPoolInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;

/**
 * Module create page.
 */
class Index extends Template
{
    /**
     * @var CreatorConfigPoolInterface
     */
    private $creatorConfigPool;

    /**
     * @var Json
     */
    private $json;

    /**
     * @param Template\Context $context
     * @param CreatorConfigPoolInterface $creatorConfigPool
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CreatorConfigPoolInterface $creatorConfigPool,
        Json $json,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->creatorConfigPool = $creatorConfigPool;
        $this->json = $json;
    }

    /**
     * Get creators init data.
     *
     * @return string
     */
    public function getCreatorsInitData(): string
    {
        $configData = [];

        try {
            foreach ($this->creatorConfigPool->getCreators() as $creator) {
                $configData[$creator->getCode()] = $creator->getConfigData();
            }
        } catch (CreatorConfigImplementationException $e) {
            $configData = [];
        }

        return $this->json->serialize($configData);
    }
}
