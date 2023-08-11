<?php

namespace Sandeep\Careers\Ui\DataProvider\JobsApplication\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class ProductDataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    /**
     * Product collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public $objectManager;

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public $collection;

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    public $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    public $addFilterStrategies;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory
     * @param array $addFieldStrategies
     * @param array $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $resultdata= $this->getCollection()->getItems();
        foreach ($resultdata as $data) {
            $this->_loadedData[$data->getId()] = $data->getData();
        }
        return $this->_loadedData;
    }

    public function getButtonData()
    {
        return [
            'custom_button' => [
                'label' => __('Download Resume'),
                'class' => 'primary',
                'on_click' => sprintf(
                    "location.href = '%s';",
                    $this->getUrl('module/controller/action', ['application_id' => $this->getContext()->getRequest()->getParam('application_id')])
                ),
                'sort_order' => 20,
            ],
        ];
    }

}
