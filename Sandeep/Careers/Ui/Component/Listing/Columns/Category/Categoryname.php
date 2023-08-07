<?php

namespace Sandeep\Careers\Ui\Component\Listing\Columns\Category;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Sandeep\Careers\Model\Category;

class Categoryname extends Column
{
    protected $category;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Category $category,
        array $components = [],
        array $data = []
    ) {
        $this->category = $category;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['job_category_id'])) {
                    $category = $this->category->load($item['job_category_id']);                    
                    $item['job_category_id'] = $category->getJobCategoryName();
                }
            }
        }

        return $dataSource;
    }
}
