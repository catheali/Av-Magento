<?php
namespace DigitalCollege\Dev\Model;

use Magento\Framework\Model\AbstractModel;

class Digital extends AbstractModel
{
    public function _construct()
    {
        /**
         * Initialize resource model
         * @return void
         */

        $this->_init('Products\RestApi\Model\ResourceModel\ApiProducts');
    }
}
