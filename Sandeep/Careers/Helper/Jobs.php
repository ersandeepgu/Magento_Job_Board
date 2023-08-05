<?php

namespace Sandeep\Careers\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Jobs extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Helper\Context
     */
    public $context;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\Jobs
     */
    public $resourceModel;
    /**
     * @var \Sandeep\Careers\Model\JobsFactory
     */
    public $modelFactory;

    /**
     * constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Model\ResourceModel\Jobs $resourceModel
     * @param \Sandeep\Careers\Model\JobsFactory $modelFactory
     */

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Sandeep\Careers\Model\ResourceModel\Jobs\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Model\ResourceModel\Jobs $resourceModel,
        \Sandeep\Careers\Model\JobsFactory $modelFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;

    }

    /**
     * Public function for addJobs Details
     *
     * @param array $data
     * @return mixed
     */
    public function addJobs($data) {
        $model = $this->modelFactory->create();
        $model->setData('job_designation', $data['job_designation']);       
        $model->setData('job_description', $data['job_description']);       
        $model->setData('job_category_id', $data['job_category_id']);       
        $model->setData('skills', $data['skills']);       
        $model->setData('meta_title', $data['meta_title']);       
        $model->setData('meta_description', $data['meta_description']);       
        $model->setData('meta_keywords', $data['meta_keywords']);       
        $saveData= $this->resourceModel->save($model);
        return $saveData;
    }
    /**
     * Public function for updateJobs Details
     *
     * @param array $data
     * @return mixed
     */

    public function updateJobs ($data)
    {           
        $id = $data['job_id'];
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id, 'job_id');
        $model->setJobDesignation($data['job_designation'])
            ->setJobDescription($data['job_description'])
            ->setJobCategoryId($data['job_category_id'])
            ->setSkills($data['skills'])
            ->setMetaTitle($data['meta_title'])
            ->setMetaDescription($data['meta_description'])
            ->setMetaKeywords($data['meta_keywords']);
        $saveData = $this->resourceModel->save($model);
        return $saveData;
    }
    /**
     * Public function for deleteJobs Details
     *
     * @param string $id
     * @return mixed
     */
    public function deleteJobs($id) {
        $model =  $this->modelFactory->create();
        $this->resourceModel->load($model,$id,'job_id');
        $saveData= $this->resourceModel->delete($model);
        return $saveData;
    }  
}