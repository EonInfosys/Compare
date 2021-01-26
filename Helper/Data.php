<?php
namespace EonInfosys\Compare\Helper;
use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Section id
     */
    const SECTION_ID = 'addonapis';

    /**
     * Enabled Path
     */
    const CONFIG_ENABLED_PATH = 'general/enable';

    /**
     *
     * @var \Magento\Config\Model\ResourceModel\Config
     */
    protected $resourceConfig;

    /**
     *
     * @var \Magento\Config\Model\Config
     */
    protected $config;

    /**
     *
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    protected $encryptor;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Config\Model\ResourceModel\Config $resourceConfig
     * @param \Magento\Config\Model\Config $config
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Config\Model\ResourceModel\Config $resourceConfig,
        \Magento\Config\Model\Config $config
    ) {
        $this->resourceConfig = $resourceConfig;
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * get module section ID
     *
     * @return string
     */
    public function getSectionId()
    {
        return self::SECTION_ID;
    }

    /**
     * disable module
     *
     * @return void
     */
    public function disableModule()
    {
        $this->resourceConfig->deleteConfig(self::SECTION_ID.'/'.self::CONFIG_ENABLED_PATH);
        $this->config->setDataByPath(self::SECTION_ID . '/' . self::CONFIG_ENABLED_PATH, 0);
        $this->config->save();
    }

    /**
     * check if module enable from configuraion
     *
     * @return bool
     */
    public function isModuleEnable()
    {
        return $this->getConfig(self::SECTION_ID.'/'.self::CONFIG_ENABLED_PATH);
    }

    /**
     * get config value
     *
     * @param  string $path
     * @param string|int  $store
     * @param string|null $scope
     * @return mixed
     */
    public function getConfig($path, $store = null, $scope = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

}
