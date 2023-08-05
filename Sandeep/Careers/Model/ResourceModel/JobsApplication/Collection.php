<?php

namespace Sandeep\Careers\Model\ResourceModel\JobsApplication;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init('Sandeep\Careers\Model\JobsApplication', 'Sandeep\Careers\Model\ResourceModel\JobsApplication');
    }
}
