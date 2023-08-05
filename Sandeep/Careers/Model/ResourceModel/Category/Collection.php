<?php

namespace Sandeep\Careers\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init('Sandeep\Careers\Model\Category', 'Sandeep\Careers\Model\ResourceModel\Category');
    }
}
