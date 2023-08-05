<?php


namespace Sandeep\Careers\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Category extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Helper\Context
     */
    public $context;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Category
     */
    public $resourceModel;
    /**
     * @var \Sandeep\Careers\Model\CategoryFactory
     */ 
    public $modelFactory;

    /**
     * constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Model\ResourceModel\Category $resourceModel
     * @param \Sandeep\Careers\Model\CategoryFactory $modelFactory
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Sandeep\Careers\Model\ResourceModel\Category\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Model\ResourceModel\Category $resourceModel,
        \Sandeep\Careers\Model\CategoryFactory $modelFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;

    }
    /**
     * Public function for addCategory Details
     *
     * @param array $data
     * @return mixed
     */
    public function addCategory($data) {
        $model = $this->modelFactory->create();
        $model->setData('job_category_name', $data['job_category_name']);
        $model->setData('meta_title', $data['meta_title']);
        $model->setData('meta_description', $data['meta_description']);
        $model->setData('meta_keywords', $data['meta_keywords']);
        $saveData= $this->resourceModel->save($model);
        return $saveData;
    }
    /**
     * Public function for deleteCategory Details
     *
     * @param string $id
     * @return mixed
     */
    public function deleteCategory($id) {
        $model =  $this->modelFactory->create();
        $this->resourceModel->load($model,$id,'job_category_id');
        $saveData= $this->resourceModel->delete($model);
        return $saveData;
    }
    /**
     * Public function for updateCategory Details
     *
     * @param array $data
     * @return mixed
     */
    public function updateCategory ($data)
    {

        // print_r($data);
        $id=$data['job_category_id'];
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model,$id,'job_category_id');
          $model->setData('job_category_name', $data['job_category_name']);
        $model->setData('meta_title', $data['meta_title']);
        $model->setData('meta_description', $data['meta_description']);
        $model->setData('meta_keywords', $data['meta_keywords']);
        $saveData= $this->resourceModel->save($model);
        return $saveData;
    }


    public function getCategoryNameById($id)
    {
       //  $model = $this->modelFactory->create();
       // return $this->resourceModel->load($model,$id,'job_category_id');
        return 'sandssssssssseep';
    }


}