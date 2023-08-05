<?php


namespace Sandeep\Careers\Controller\Adminhtml\Jobs;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class Delete
 *
 * @package Sandeep\Careers\Controller\Adminhtml\Jobs
 */
class Delete extends Action
{
    /**
     * @var Action\Context
     */
    public $context;

    /**
     * @var \Sandeep\Careers\Helper\Control
     */
    public $helper;

    /**
     * Constructor.
     *
     * @param Action\Context $context
     * @param \Sandeep\Careers\Helper\Control $helper
     */
    public function __construct(
        Action\Context $context,
        \Sandeep\Careers\Helper\Jobs $helper
    ){
        parent::__construct($context);
        $this->helper= $helper;
    }
    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute(){
        $id = $this->getRequest()->getParam("job_id");
        $this->helper->deleteJobs($id);
        $this->messageManager->addSuccess( __('Jobs Details Deleted Successfully !') );
        return $this->resultRedirectFactory->create()->setPath('careers/jobs/index');
    }
}
?>





