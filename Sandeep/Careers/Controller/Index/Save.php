<?php


namespace Sandeep\Careers\Controller\Index;

use Magento\Framework\App\Action\Context;
use Sandeep\Careers\Model\JobsApplicationFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $jobapplication;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    public function __construct(
        Context $context,
        JobsApplicationFactory $jobapplication,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->jobapplication = $jobapplication;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if(isset($_FILES['resume_path']['name']) && $_FILES['resume_path']['name'] != '') {

            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'resume_path']);
                $uploaderFactory->setAllowedExtensions(['pdf', 'docx']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('sandeep/careers');
                $result = $uploaderFactory->save($destinationPath);
            print_r($result);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                
                $imagePath = 'sandeep/careers'.$result['file'];
                $data['resume_path'] = $imagePath;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                // return $e->getMessage();
            // die('sa');
            }
        }
            // die('sawww');
        $job = $this->jobapplication->create();
        $job->setData($data);
        if($job->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('careers/index/');
        return $resultRedirect;
    }
}
