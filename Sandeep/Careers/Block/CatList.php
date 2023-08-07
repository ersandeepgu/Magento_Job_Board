<?php

namespace Sandeep\Careers\Block;

use Magento\Framework\View\Element\Template\Context;
use Sandeep\Careers\Helper\Category;
use Magento\Framework\App\Config\ScopeConfigInterface;


/**
 * jobs List block
 */
class CatList extends \Magento\Framework\View\Element\Template
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

     /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;


    public function __construct(
        Context $context,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        Category $categoryHelper,
        ScopeConfigInterface $scopeConfig

    ) {
        $this->jobsCollection = $collectionFactory->create();
        $this->categoryCollection = $categoryCollectionFactory->create();
        $this->categoryHelper = $categoryHelper;
        $this->scopeConfig = $scopeConfig;
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


    public function getJobCount($id)
    {       
        $collection = $this->jobsCollection->addFieldToFilter('job_category_id', $id);
        return $collection->getSize(); 
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


    public function getFileType() {
        return $this->scopeConfig->getValue(
            'sandeep_config/general/allowed_files',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
