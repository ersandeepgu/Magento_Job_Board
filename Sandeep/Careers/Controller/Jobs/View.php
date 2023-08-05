<?php

namespace Sandeep\Career\Controller\Jobs;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class View extends Action
{
    /**
     * @var JobRepository
     */
    private $jobsFactory;
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * View constructor.
     *
     * @param Context       $context
     * @param JobRepository $jobRepository
     * @param PageFactory   $resultPageFactory
     * @internal param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->collection = $collectionFactory->create();
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // Get param id
        $id = $this->getRequest()->getParam('id');

        // No id, redirect
        if(empty($id)){
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        $job = $this->collection->getById($id);
        // Model not exists with this id, redirect
        if (!$job->getId()) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
