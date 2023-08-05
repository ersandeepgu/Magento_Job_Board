<?php

namespace Sandeep\Careers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class JobsApplication extends AbstractDb {
    protected function _construct() {
        /* tablename, primarykey*/
        $this->_init('job_applications', 'application_id');
    }
}


