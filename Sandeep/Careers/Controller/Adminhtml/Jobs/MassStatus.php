<?php

namespace Sandeep\Careers\Controller\Adminhtml\Jobs;

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
    public $jobsFactory;

    /**
     * @var $jobsCollectionFactory
     */
    public $jobsCollectionFactory;

    /**
     * MassStatus constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
     * @param \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $jobsCollectionFactory
     * @param \Sandeep\Careers\Model\JobsFactory $jobsFactory
     * @param \Sandeep\Careers\Helper\Data $data
     */
    public function __construct(
        Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $jobsCollectionFactory,
        \Sandeep\Careers\Model\jobsFactory $jobsFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->jobsFactory = $jobsFactory;
        $this->jobsCollectionFactory = $jobsCollectionFactory;
    }
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $jobsIds = $this->filter->getCollection($this->jobsCollectionFactory->create())->getAllIds();
        $status = $this->getRequest()->getParam('status', 1);

        if (!empty($jobsIds)) {
            try {
                foreach ($jobsIds as $jobsId) {
                    $jobs = $this->_objectManager->create(\Sandeep\Careers\Model\Jobs::class)->load($jobsId);
                    $jobs->setJobStatus($status);
                    $jobs->save();
                }
                if ($status == 0) {
                    $this->messageManager->addSuccessMessage(__('Total of %1 record(s) have been disabled.', count($jobsIds)));
                } else {
                    $this->messageManager->addSuccessMessage(__('Total of %1 record(s) have been enabled.', count($jobsIds)));
                }
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect('careers/jobs/index');
    }
}
