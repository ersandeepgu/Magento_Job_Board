<?php

namespace Sandeep\Careers\Ui\Component\Listing\Columns\Category;

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
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
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
                if (isset($item['job_category_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                'careers/category/edit',
                                [
                                    'job_category_id' => $item['job_category_id'],
                                ]
                            ),
                            'label' => __('Edit'),
                            'class' => 'actions edit'
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                'careers/category/delete',
                                [
                                    'job_category_id' => $item['job_category_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'class' => 'actions delete',
                            'confirm' => [
                                'title' => __('Delete'),
                                'message' => __('Are you sure you wan\'t to delete the record?')
                            ]
                        ],

                    ];
                }
            }
        }
        return $dataSource;
    }


}
