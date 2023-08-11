<?php

namespace Sandeep\Careers\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Exception\LocalizedException;
use Sandeep\Careers\Helper\JobsApplication;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    protected $helper;

    public function __construct(
        Context $context,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        JobsApplication $helper,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->helper = $helper;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        try {
            $data = $this->getRequest()->getPostValue();
            
            if (!empty($data)) {
                $files = $this->getRequest()->getFiles();
                if (isset($files['resume_path']) && !empty($files['resume_path']['name'])) {
                    $uploader = $this->uploaderFactory->create(['fileId' => 'resume_path']);
                    $file = $files['resume_path'];
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $fileType = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('sandeep_config/general/allowed_files');
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $allowedFileTypes = explode(',' ,$fileType); 
                    if (!in_array($ext, $allowedFileTypes)) {
                        throw new LocalizedException(__('Invalid file type. Allow file type ' . $fileType));
                    }

                    
                    $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                    $destinationPath = $mediaDirectory->getAbsolutePath('sandeep/careers');
                    
                    $uploader->setAllowedExtensions($allowedFileTypes);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $result = $uploader->save($destinationPath);
                    $imagePath = $result['file'];
                    $data['resume_path'] = $imagePath;
                }
                
                $data['status'] = 0;
                $save = $this->helper->addJobsApplication($data);
                
                if ($save) {
                    $this->messageManager->addSuccessMessage(__('Your Application was submitted successfully.'  ));
                } else {
                    $this->messageManager->addErrorMessage(__('Something went wrong. Please try again.'));
                }
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('careers/index/');
        return $resultRedirect;
    }
}
