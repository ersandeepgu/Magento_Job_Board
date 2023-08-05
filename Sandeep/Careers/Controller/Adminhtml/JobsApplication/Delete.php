<?php


namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class Delete
 *
 * @package Sandeep\Careers\Controller\Adminhtml\JobsApplication
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
        \Sandeep\Careers\Helper\JobsApplication $helper
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
        $id = $this->getRequest()->getParam("application_id");
        $this->helper->deleteJobsApplication($id);
        $this->messageManager->addSuccess( __('JobsApplication Details Deleted Successfully !') );
        return $this->resultRedirectFactory->create()->setPath('careers/jobsapplication/index');
    }
}
?>





