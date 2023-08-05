<?php

namespace Sandeep\Careers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb {
    protected function _construct() {
        /* tablename, primarykey*/
        $this->_init('job_categories', 'job_category_id');
    }
}