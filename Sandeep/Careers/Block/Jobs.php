<?php

namespace Sandeep\Careers\Block;

use Magento\Framework\View\Element\Template\Context;
use Sandeep\Careers\Helper\Category;

/**
 * jobs List block
 */
class Jobs extends \Magento\Framework\View\Element\Template
{
    /**
     * @var jobs
     */
    protected $jobsCollection;
    protected $categoryCollection;


    /**
     * @var Data
     */
    private $categoryHelper;

    public function __construct(
        Context $context,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        Category $categoryHelper,

    ) {
        $this->jobsCollection = $collectionFactory->create();
        $this->categoryCollection = $categoryCollectionFactory->create();
        $this->categoryHelper = $categoryHelper;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('We are hiring !'));       
        return parent::_prepareLayout();
    }

    public function getJobsCollection()
    {
        $collection = $this->jobsCollection->getData();
        return $collection;
    }

    public function getCategoryCollection()
    {
        $collection = $this->categoryCollection->getData();  
        return $collection;
    }


    public function getCategoryNameById($id)
    {
        $collection = $this->categoryCollection->addFieldToFilter('job_category_id', $id)->getFirstItem();
        return $collection->getJobCategoryName();      
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
