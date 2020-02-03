<?php

declare(strict_types=1);

namespace Ivan\News\Model;

use Ivan\News\Model\ResourceModel\News as NewsResourceModel;
use Ivan\NewsApi\Api\Data\NewsExtensionInterface;
use Ivan\NewsApi\Api\Data\NewsInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * News model.
 */
class News extends AbstractExtensibleModel implements NewsInterface
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(NewsResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getNewsId(): ?int
    {
        return $this->getId() ? (int)$this->getId() : null;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->_getData(NewsInterface::FIELD_TITLE) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): NewsInterface
    {
        $this->setData(NewsInterface::FIELD_TITLE, $title);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getText(): ?string
    {
        return $this->_getData(NewsInterface::FIELD_TEXT) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function setText(string $text): NewsInterface
    {
        $this->setData(NewsInterface::FIELD_TEXT, $text);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIsActive(): bool
    {
        return (bool)$this->_getData(NewsInterface::FIELD_IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $isNewsActive): NewsInterface
    {
        $this->setData(NewsInterface::FIELD_IS_ACTIVE, $isNewsActive ? 1 : 0);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes(): ?NewsExtensionInterface
    {
        $extensionAttributes = $this->_getExtensionAttributes();

        if (null === $extensionAttributes) {
            $extensionAttributes = $this->extensionAttributesFactory->create(NewsInterface::class);
            $this->setExtensionAttributes($extensionAttributes);
        }

        return $extensionAttributes;
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(NewsExtensionInterface $extensionAttributes): void
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
