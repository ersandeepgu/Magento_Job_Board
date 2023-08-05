<?php

namespace Sandeep\Careers\Model\Source;
 
use Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
 
class Category implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * Class toOptionArray
     *
     * @return array
     */


    public function toOptionArray()
    {
        $options = [];
        $collection = $this->collectionFactory->create();
        $options[] = ['label' => '-- Please Select Category --', 'value' => ''];
        foreach($collection as $category) {
            $options[] = ['label' => $category->getJobCategoryName(), 'value' => $category->getJobCategoryId()];
        }
        return $options;
    }   
}

