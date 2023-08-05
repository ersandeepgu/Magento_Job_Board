<?php

namespace Sandeep\Careers\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 *
 * @package Sandeep\Careers\Controller\Adminhtml\Category
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    public $filter;
    /**
     * @var Context
     */
    public $context;

    /**
     * @var \Sandeep\Careers\Helper\Categorys
     */
    public $helper;

    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Categorys\CollectionFactory
     */
    public $collectionFactory;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param Filter $filter
     * @param \Sandeep\Careers\Model\ResourceModel\Categorys\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Helper\Categorys $helper
     */
    public function __construct(
        Context $context,
        Filter $filter,
        \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Helper\Category $helper
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
            $this->helper->deleteCategory($model['job_category_id']);
            $count++;
        }
        $this->messageManager->addSuccess(__('A total of %1 Category have been deleted.', $count));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
