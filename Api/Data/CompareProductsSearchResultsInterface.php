<?php
namespace EonInfosys\Compare\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for compare products search results.
 * @api
 * @since 1.0.0
 */
interface CompareProductsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get compare products list.
     *
     * @return \EonInfosys\Compare\Api\Data\CompareProductsInterface[]
     */
    public function getItems();

    /**
     * Set compare products list.
     *
     * @param \EonInfosys\Compare\Api\Data\CompareProductsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
