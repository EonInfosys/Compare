<?php
namespace EonInfosys\Compare\Api\Data;

/**
 * Interface CompareProductsInterface
 */
interface CompareProductsInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const LABEL_COMPARE_ITEM_ID = 'compare_item_id';
    const LABEL_CUSTOMER_ID = 'customer_id';
    const LABEL_VISITOR_ID = 'visitor_id';
    const LABEL_ITEM_STORE_ID = 'item_store_id';
    const LABEL_CREATED_AT = 'created_at';
    const LABEL_UPDATED_AT = 'updated_at';

    /**
     * Set Compare Item Id
     *
     * @param  int $compareItemId
     * @return $this
     */
    public function setCompareItemId($compareItemId);

    /**
     * Get Compare Item Id
     *
     * @return int
     */
    public function getCompareItemId();

    /**
     * Set Customer Id
     *
     * @param  int $customerId
     * @return $this
     */
    public function setCustomerId($customerId = null);

    /**
     * Get Customer Id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set Visitor Id
     *
     * @param  int $visitorId
     * @return $this
     */
    public function setVisitorId($visitorId);

    /**
     * Get Visitor Id
     *
     * @return int
     */
    public function getVisitorId();

    /**
     * Set Item Store Id
     *
     * @param  int $itemStoreId
     * @return $this
     */
    public function setItemStoreId($itemStoreId);

    /**
     * Get Item Store Id
     *
     * @return int
     */
    public function getItemStoreId();

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set Created At
     *
     * @param  string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set Updated At
     *
     * @param  string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \EonInfosys\Compare\Api\Data\CompareProductsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \EonInfosys\Compare\Api\Data\CompareProductsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(CompareProductsExtensionInterface $extensionAttributes);
}
