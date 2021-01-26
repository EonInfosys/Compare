<?php
namespace EonInfosys\Compare\Model;
use Magento\Framework\Exception\AuthorizationException;

class AddonAPIs
{

    /**
     * @var \EonInfosys\Compare\Helper\Data
     */
    protected $helper;

    /**
     * @param \EonInfosys\Compare\Helper\Data $helper
     */
    public function __construct(
        \EonInfosys\Compare\Helper\Data $helper
    ) {
        $this->helper = $helper;
        $this->checkModuleStatus();
    }

    public function checkModuleStatus()
    {
        // if(!$this->helper->isModuleEnable()){
        //     throw new AuthorizationException(
        //         __('You are not authorized to access this resource. Please enable the module first.')
        //     );
        // }
    }
}
