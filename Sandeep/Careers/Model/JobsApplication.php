<?php

namespace Sandeep\Careers\Model;

use Magento\Framework\Model\AbstractModel;

class JobsApplication extends AbstractModel {
    protected function _construct() {
        /* full resource classname */
        $this->_init('Sandeep\Careers\Model\ResourceModel\JobsApplication');
    }
}