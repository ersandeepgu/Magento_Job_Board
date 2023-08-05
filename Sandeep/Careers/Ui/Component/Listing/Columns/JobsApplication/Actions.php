<?php

namespace Sandeep\Careers\Ui\Component\Listing\Columns\jobsapplication;

use Sandeep\Careers\Model\jobsapplication;
use Magento\Framework\AuthorizationInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Actions extends Column
{
    /**
     * @var UiComponentFactory
     */
    public $uiComponentFactory;

    /**
     * @var ContextInterface
     */
    public $context;

    /**
     * @var UrlInterface
     */
    public $urlBuilder;

    /**
     * @var \Magento\Framework\Locale\CurrencyInterfac
     */
    public $localeCurrency;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param \Magento\Framework\Locale\CurrencyInterface $localeCurrency
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        \Magento\Framework\Locale\CurrencyInterface $localeCurrency,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->localeCurrency = $localeCurrency;
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * PrepareDataSource
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
               
                $item[$name] = [];
                if (isset($item['application_id'])) {
                   
                    $item[$name]["edit"] = [
                        "href" => $this->getContext()->getUrl(
                            "careers/jobsapplication/edit",
                            ['application_id' => $item['application_id']]
                        ),
                        'label' => __('Edit'),
                        'class' => 'actions edit'
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->getContext()->getUrl(
                            'careers/jobsapplication/delete',
                            ['application_id' => $item['application_id']]
                        ),
                        'label' => __('Delete'),
                        'class' => 'actions delete',
                        'confirm' => [
                            'title' => __('Delete'),
                            'message' => __('Are you sure you wan\'t to delete the record?')
                        ]
                    ];

                }
            }
        }        
        return $dataSource;
    }


}
