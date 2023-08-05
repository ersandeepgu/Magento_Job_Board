<?php

namespace Sandeep\Careers\Model\ResourceModel\Jobs;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init('Sandeep\Careers\Model\Jobs', 'Sandeep\Careers\Model\ResourceModel\Jobs');
    }
}
