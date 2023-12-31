<?php

namespace Sandeep\Careers\Block;

use Magento\Framework\View\Element\Template\Context;
use Sandeep\Careers\Model\CategoryFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Category extends \Magento\Framework\View\Element\Template
{
   
    Const LIST_FILES_ENABLED = 'sandeep_config/general/allowed_files';

    protected $category;
    public function __construct(
        Context $context,
        CategoryFactory $category,
        ScopeConfigInterface $scopeConfig,
        FilterProvider $filterProvider
    ) {
        $this->category = $category;
        $this->_filterProvider = $filterProvider;
        $this->scopeConfig = $scopeConfig;
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
        $jobdata = $this->category->create();
        $singleData = $jobdata->load($id);      
       
        if($singleData->getJobCategoryId() || $singleData['job_category_id']){
            return $singleData;
        }else{
            return false;
        }
    }


    public function getFileType() {
        return $this->scopeConfig->getValue(
            'sandeep_config/general/allowed_files',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}