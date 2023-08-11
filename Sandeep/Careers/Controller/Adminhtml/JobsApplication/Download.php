<?php
namespace Sandeep\Careers\Controller\Adminhtml\JobsApplication;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Download extends Action
{
    public $modelFactory;
    
    public function __construct(
        Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem\DirectoryList $directory,
        \Sandeep\Careers\Model\JobsApplicationFactory $modelFactory
    ) {
         $this->modelFactory = $modelFactory;
         $this->_downloader = $fileFactory;
         $this->directory = $directory;
        parent::__construct($context);
    }

    public function execute()
    {        
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('application_id');
        try {
            $JobsApplicationModel = $this->modelFactory->create();
            $JobsApplicationModel->load($id);

            $fileName = $JobsApplicationModel->getResumePath(); 
            $file = $this->directory->getPath("media")."/sandeep/careers/".$fileName;
            return $this->_downloader->create(
                   $fileName,
                   @file_get_contents($file)
             );
            $this->messageManager->addSuccessMessage(__('You downloaded the pdf file.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }
}
