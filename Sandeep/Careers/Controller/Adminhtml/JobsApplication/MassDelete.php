<?php


namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 *
 * @package Sandeep\Careers\Controller\Adminhtml\JobsApplication
 */
class MassDelete extends Action
{
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var \Sandeep\Careers\Helper\JobsApplication
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
     * @param \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Helper\JobsApplication $helper
     */
    public function __construct(
        Context $context,
        Filter $filter,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Helper\JobsApplication $helper
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
            $this->helper->deleteJobsApplication($model['application_id']);
            $count++;
        }
        $this->messageManager->addSuccess(__('A total of %1  JobsApplication Details have been deleted.', $count));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
