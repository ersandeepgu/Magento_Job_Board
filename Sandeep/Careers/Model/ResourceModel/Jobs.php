<?php

namespace Sandeep\Careers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Jobs extends AbstractDb {
    protected function _construct() {
        /* tablename, primarykey*/
        $this->_init('jobs', 'job_id');
    }
}