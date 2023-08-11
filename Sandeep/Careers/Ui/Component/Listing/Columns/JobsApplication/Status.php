<?php

namespace Sandeep\Careers\Ui\Component\Listing\Columns\JobsApplication;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Status
 */
class Status extends Column
{

    /**
     * Status constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        $components = [],
        $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');

            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item[$fieldName])) {
                    switch ($item[$fieldName]) {
                        case 0:
                            $item[$fieldName . '_html'] = "<div class='grid-severity-notice'><span>Pending</span></div>";
                            $item[$fieldName . '_title'] = __('Status');
                            break;
                        case 1:
                            $item[$fieldName . '_html'] = '<div class="grid-severity-critical"><span>Active</span></div>';
                            $item[$fieldName . '_title'] = __('Status');
                            break;
                        case 2:
                            $item[$fieldName . '_html'] = '<div class="grid-severity-critical"><span>Closed</span></div>';
                            $item[$fieldName . '_title'] = __('Status');
                            break;
                        case 3:
                            $item[$fieldName . '_html'] = '<div class="grid-severity-critical"><span>Rejected</span></div>';
                            $item[$fieldName . '_title'] = __('Status');
                            break;
                    }
                }
            }
        }

        return $dataSource;
    }
}
