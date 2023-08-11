<?php

namespace Sandeep\Careers\Block;

use Magento\Framework\View\Element\Template\Context;
use Sandeep\Careers\Model\JobsFactory;
use Magento\Cms\Model\Template\FilterProvider;


class JobStatus extends \Magento\Framework\View\Element\Template
{
   
    protected $jobs;
    public function __construct(
        Context $context,
        JobsFactory $job,
        FilterProvider $filterProvider
    ) {
        $this->job = $job;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('View Job'));
        
        return parent::_prepareLayout();
    }

    public function getSingleData()
    {
        $id = $this->getRequest()->getParam('id');
        $jobdata = $this->job->create();
        $singleData = $jobdata->load($id);
       
        if($singleData->getJobId() || $singleData['job_id'] && $singleData->getJobStatus() == 1){
            return $singleData;
        }else{
            return false;
        }
    }
}