<?php

namespace Sandeep\Careers\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Sandeep\Careers\Controller\Adminhtml\Category
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * Feeds constructor.
     *
     * @param Action\Context $context
     * @param PageFactory    $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute()
    {
        /**
 		 * @var \Magento\Backend\Model\View\Result\Page $resultPage 
         */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sandeep_Careers::categories');
        $resultPage->getConfig()->getTitle()->prepend(__('Category'));
        return $resultPage;
    }
}
