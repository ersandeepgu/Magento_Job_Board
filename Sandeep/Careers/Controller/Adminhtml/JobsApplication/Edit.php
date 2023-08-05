<?php


namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param PageFactory $rawFactory
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory
    ) {
        $this->pageFactory = $rawFactory;
        parent::__construct($context);
    }

    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit JobsApplication details'));
        return $resultPage;
    }
}

