<?php

declare(strict_types=1);

namespace Ivan\NewsApi\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * News model interface.
 */
interface NewsInterface extends ExtensibleDataInterface
{
    /**
     * News ID field name.
     */
    public const FIELD_ID = 'id';

    /**
     * News title field name.
     */
    public const FIELD_TITLE = 'title';

    /**
     * News text field name.
     */
    public const FIELD_TEXT = 'text';

    /**
     * Is news active field name.
     */
    public const FIELD_IS_ACTIVE = 'is_active';

    /**
     * Get news ID.
     *
     * @return null|int
     */
    public function getNewsId(): ?int;

    /**
     * Return news title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set news title.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self;

    /**
     * Return news content.
     *
     * @return string|null
     */
    public function getText(): ?string;

    /**
     * Set news content.
     *
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self;

    /**
     * Return is news active.
     *
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * Set is news active.
     *
     * @param bool $isNewsActive
     * @return $this
     */
    public function setIsActive(bool $isNewsActive): self;

    /**
     * Retrieve existing extension attributes object.
     *
     * @return \Ivan\NewsApi\Api\Data\NewsExtensionInterface|null
     */
    public function getExtensionAttributes(): ?\Ivan\NewsApi\Api\Data\NewsExtensionInterface;

    /**
     * Set an extension attributes object.
     *
     * @param \Ivan\NewsApi\Api\Data\NewsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Ivan\NewsApi\Api\Data\NewsExtensionInterface $extensionAttributes): void;
}
