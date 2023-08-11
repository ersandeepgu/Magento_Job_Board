<?php
namespace Sandeep\Careers\Ui\Component\Listing\Columns\JobsApplication;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;


class Download extends \Magento\Ui\Component\Listing\Columns\Column
{
    // public const URL_PATH_DOWNLOAD = 'wellnessextract_jobapplication/items/download';

    /**
     * @var UrlInterface
     */
    public $urlBuilder;


    public $modelFactory;


    public $storeManager;



    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        \Magento\Framework\Filesystem\DirectoryList $directory,
        StoreManagerInterface $storeManager,
        \Sandeep\Careers\Model\JobsApplicationFactory $modelFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->modelFactory = $modelFactory;
        $this->directory = $directory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /** 
     * Public function prepareDataSource
     *
     * @param array $dataSource
     * @return array
     */



    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['application_id'])) {
                    $viewUrlPath = $this->getData('config/viewUrlPath');
                    $downloadUrlPath = $this->getData('config/downloadUrlPath');
                    $urlEntityParamName = $this->getData('config/urlEntityParamName');                
                    $item[$this->getData('name')] = [
                        'view' => [                            
                            'href' => $this->viewResumeUrl($item['application_id']),
                            'label' => __('View'),
                            'target' => '_blank', 
                            'icon' => '<img src="' . $this->getViewFileUrl('Sandeep_Careers::images/download-icon.png') . '" alt="Download Icon" />',
                            'class' => 'sandeep actions view',
                        ],
                        'download' => [                           
                            'label' => __('Download'),
                            'href' => '<img src="' . $this->getViewIconUrl() . '" alt="Download Icon" />',

                            'class' => 'sandeep actions download',
                            // 'icon' => $this->getDownloadIconUrl(),
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }


    /**
     * Get the URL for the view icon image
     *
     * @return string
     */
    protected function viewResumeUrl($applicationId)
    {
        $jobsApplication = $this->modelFactory->create();
        $jobsApplication->load($applicationId);  
        $fileName = $jobsApplication->getResumePath(); 
        return $file = $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ) . 'sandeep/careers/' . $fileName;
    }


    protected function getViewIconUrl()
    {
        return $this->getViewFileUrl("Sandeep_Careers::images/actions/eye.png");
    }

    /**
     * Get the URL for the download icon image
     *
     * @return string
     */
    protected function getDownloadIconUrl()
    {
        return $this->getViewFileUrl("Sandeep_Careers::images/actions/download.png");
    }
}

