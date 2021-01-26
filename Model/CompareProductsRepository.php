<?php
namespace EonInfosys\Compare\Model;

use EonInfosys\Compare\Api\CompareProductsRepositoryInterface;

class CompareProductsRepository extends AddonAPIs implements CompareProductsRepositoryInterface
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Compare\Item\CollectionFactory
     */
    protected $compareCollectionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $catalogProductVisibility;

    /**
     * @var \EonInfosys\Compare\Api\Data\CompareProductsInterfaceFactory
     */
    protected $compareProductsInterfaceFactory;

    /**
     * @var \EonInfosys\Compare\Api\Data\CompareProductsExtensionInterfaceFactory
     */
    protected $compareProductsExtension;

    /**
     * @var \EonInfosys\Compare\Api\Data\CompareProductsSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;


    /**
     * @param \EonInfosys\Compare\Helper\Data $helper
     * @param \Magento\Catalog\Model\ResourceModel\Product\Compare\Item\CollectionFactory $compareCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility
     * @param \EonInfosys\Compare\Api\Data\CompareProductsInterfaceFactory $compareProductsInterfaceFactory
     * @param \EonInfosys\Compare\Api\Data\CompareProductsExtensionInterfaceFactory $compareProductsExtension
     * @param \EonInfosys\Compare\Api\Data\CompareProductsSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \EonInfosys\Compare\Helper\Data $helper,
        \Magento\Catalog\Model\ResourceModel\Product\Compare\Item\CollectionFactory $compareCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \EonInfosys\Compare\Api\Data\CompareProductsInterfaceFactory $compareProductsInterfaceFactory,
        \EonInfosys\Compare\Api\Data\CompareProductsExtensionInterfaceFactory $compareProductsExtension,
        \EonInfosys\Compare\Api\Data\CompareProductsSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->compareCollectionFactory = $compareCollectionFactory;
        $this->storeManager = $storeManager;
        $this->productRepository = $productRepository;
        $this->catalogProductVisibility = $catalogProductVisibility;
        $this->compareProductsInterfaceFactory = $compareProductsInterfaceFactory;
        $this->compareProductsExtension = $compareProductsExtension;
        $this->searchResultsFactory  = $searchResultsFactory;
        parent::__construct($helper);
    }

    /**
     * @inheritDoc
     */
    public function getList($customerId, $limit = 10)
    {
        $collections = $this->compareCollectionFactory->create();
        $collections->useProductItem(true)->setStoreId($this->storeManager->getStore()->getId());

        $collections->setCustomerId($customerId);

        $collections->setVisibility($this->catalogProductVisibility->getVisibleInSiteIds());

        /* Price data is added to consider item stock status using price index */
        $collections->addPriceData();

        $collections->addAttributeToSelect('name')->addUrlRewrite()->load()->setPageSize(
            $limit
        );
        $data = [];
        foreach ($collections as $collection) {
            $compareProducts = $this->compareProductsInterfaceFactory->create();
            $compareProducts->setCompareItemId($collection->getCatalogCompareItemId());
            $compareProducts->setCustomerId($collection->getCustomerId());
            $compareProducts->setVisitorId($collection->getVisitorId());
            $compareProducts->setItemStoreId($collection->getItemStoreId());
            $compareProducts->setCreatedAt($collection->getCreatedAt());
            $compareProducts->setUpdatedAt($collection->getUpdatedAt());
      //  echo $collection->getSku(); exit;
            $product = $this->productRepository->get($collection->getSku());
            $extensionAttributes = $compareProducts->getExtensionAttributes();
            if ($extensionAttributes === null) {
                $extensionAttributes = $this->compareProductsExtension->create();
            }
            $extensionAttributes->setProduct($product);
            $compareProducts->setExtensionAttributes($extensionAttributes);
            $data[] = $compareProducts;

        }
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($data);
        $searchResults->setTotalCount($collections->count());
        return $searchResults;

    }
}
