<?php
namespace EonInfosys\Compare\Api;

interface CompareProductsRepositoryInterface
{
    /**
     * Get compare products
     *
     * @param int $customerId
     * @param int $limit
     * @return \EonInfosys\Compare\Api\Data\CompareProductsSearchResultsInterface
     */
    public function getList($customerId, $limit = 10);
}
