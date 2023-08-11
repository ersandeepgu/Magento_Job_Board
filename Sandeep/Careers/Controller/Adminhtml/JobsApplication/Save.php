<?php

namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var Context
     */
    public $context;

    /**
     * @var \Sandeep\Careers\Helper\JobsApplication
     */
    public $helper;

    /**
     * @var \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory
     */
    public $collection;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param \Sandeep\Careers\Helper\JobsApplication $helper
     */
    public function __construct(
        Context $context,
        \Sandeep\Careers\Helper\JobsApplication $helper,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collection 
    ) {
        $this->helper = $helper;
        $this->collection = $collection;
        parent::__construct($context);
    }
    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();        
        $id = $this->getRequest()->getParam("application_id");
        if($id) {
            $this->helper->updateJobsApplication($data);
            $this->messageManager->addSuccess( __("Update JobsApplication's Details Successfully") );
            return $this->resultRedirectFactory->create()->setPath('careers/jobsapplication/index');
        } else {
           $this->helper->addJobsApplication($data);
            $this->messageManager->addSuccess( __("Add JobsApplication's Details Successfully") );
            return $this->resultRedirectFactory->create()->setPath('careers/jobsapplication/index');
           
        }

    }
}
