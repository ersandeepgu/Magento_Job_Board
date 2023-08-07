<?php


namespace Sandeep\Careers\Controller\Index;

use Magento\Framework\App\Action\Context;
use Sandeep\Careers\Model\JobsApplicationFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManagerInterface;


class Save extends \Magento\Framework\App\Action\Action
{
   
    Const LIST_FILES_ENABLED = 'sandeep_config/general/allowed_files';
	
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    protected $jobsapplication;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem; 

    public function __construct(
		Context $context,
        JobsApplicationFactory $jobsapplication,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        StoreManagerInterface $storeManager
    ) {
        $this->jobsapplication = $jobsapplication;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
	public function execute()
    {
die('sassa');
        $data = $this->getRequest()->getParams();

        $allowfileTypes = $this->scopeConfig->getValue(self::LIST_FILES_ENABLED);

        print_r($allowfileTypes);

        // die('sasas');
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);

                $allowfileTypes = $this->scopeConfig->getValue(self::LIST_FILES_ENABLED);
                $uploaderFactory->setAllowedExtensions($allowfileTypes);
                // $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('sandeep/gupta');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                
                $imagePath = 'sandeep/gupta'.$result['file'];
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
            }
        }
    	$gupta = $this->_gupta->create();
        $gupta->setData($data);
        if($gupta->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('gupta');
        return $resultRedirect;
    }
}
