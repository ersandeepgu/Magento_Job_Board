<?php

namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;

use Magento\Backend\App\Action\Context;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @var $filter
     */
    public $filter;

    /**
     * @var $profileFactory
     */
    public $jobsapplicationFactory;
    /**
     * @var $jobsapplicationCollectionFactory
     */
    public $jobsapplicationCollectionFactory;

    /**
     * MassStatus constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
     * @param \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $jobsapplicationCollectionFactory
     * @param \Sandeep\Careers\Model\JobsApplicationFactory $jobsapplicationFactory
     * @param \Sandeep\Careers\Helper\Data $data
     */
    public function __construct(
        Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $jobsapplicationCollectionFactory,
        \Sandeep\Careers\Model\jobsapplicationFactory $jobsapplicationFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->jobsapplicationFactory = $jobsapplicationFactory;
        $this->jobsapplicationCollectionFactory = $jobsapplicationCollectionFactory;
    }
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $jobsapplicationIds = $this->filter->getCollection($this->jobsapplicationCollectionFactory->create())->getAllIds();      
        $status = $this->getRequest()->getParam('status', 1);
        if (!empty($jobsapplicationIds)) {
            try {
                foreach ($jobsapplicationIds as $jobsId) {
                    $jobs = $this->_objectManager->create(\Sandeep\Careers\Model\JobsApplication::class)->load($jobsId);
                    $jobs->setStatus($status);
                    $jobs->save();
                }
                if ($status == 0) {
                    $this->messageManager->addSuccessMessage(__('Total of %1 record(s) have been disabled.', count($jobsapplicationIds)));
                } else {
                    $this->messageManager->addSuccessMessage(__('Total of %1 record(s) have been enabled.', count($jobsapplicationIds)));
                }
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('careers/jobsapplication/index');
    }
}
