<?php

namespace Sandeep\Careers\Controller\Adminhtml\Jobs;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var Context
     */
    public $context;

    /**
     * @var \Sandeep\Careers\Helper\Jobs
     */
    public $helper;

    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory
     */
    public $collection;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param \Sandeep\Careers\Helper\Jobs $helper
     */
    public function __construct(
        Context $context,
        \Sandeep\Careers\Helper\Jobs $helper,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collection 
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
        $id = $this->getRequest()->getParam("job_id");
        if($id) {
            $this->helper->updateJobs($data);
            $this->messageManager->addSuccess( __("Update Jobs's Details Successfully") );
            return $this->resultRedirectFactory->create()->setPath('careers/Jobs/index');
        } else {
           $this->helper->addJobs($data);
            $this->messageManager->addSuccess( __("Add Jobs's Details Successfully") );
            return $this->resultRedirectFactory->create()->setPath('careers/Jobs/index');
           
        }

    }
}
