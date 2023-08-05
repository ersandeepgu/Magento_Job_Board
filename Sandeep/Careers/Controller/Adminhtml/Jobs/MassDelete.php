<?php


namespace Sandeep\Careers\Controller\Adminhtml\Jobs;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 *
 * @package Sandeep\Careers\Controller\Adminhtml\Jobs
 */
class MassDelete extends Action
{
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var \Sandeep\Careers\Helper\Jobs
     */
    public $helper;
    /**
     * @var Filter
     */
    public $filter;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param Filter $filter
     * @param \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Helper\Jobs $helper
     */
    public function __construct(
        Context $context,
        Filter $filter,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Helper\Jobs $helper
    ){
        parent::__construct($context);
        $this->helper= $helper;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute(){
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $count = 0;
        foreach ($collection as $model) {
            $this->helper->deleteJobs($model['job_id']);
            $count++;
        }
        $this->messageManager->addSuccess(__('A total of %1  Jobs Details have been deleted.', $count));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
