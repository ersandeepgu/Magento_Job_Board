<?php


namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class NewJobsApplication
 *
 * @package Sandeep\Careers\Controller\Adminhtml\JobsApplication
 */
class NewJobsApplication extends Action
{
    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * Constructor.
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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Add JobsApplication'));
        return $resultPage;
    }
}
