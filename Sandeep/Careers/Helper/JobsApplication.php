<?php

namespace Sandeep\Careers\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class JobsApplication extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Helper\Context
     */
    public $context;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var \Sandeep\Careers\Model\ResourceModel\JobsApplication
     */
    public $resourceModel;
    /**
     * @var \Sandeep\Careers\Model\JobsApplicationFactory
     */
    public $modelFactory;

    /**
     * constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory
     * @param \Sandeep\Careers\Model\ResourceModel\JobsApplication $resourceModel
     * @param \Sandeep\Careers\Model\JobsApplicationFactory $modelFactory
     */

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication\CollectionFactory $collectionFactory,
        \Sandeep\Careers\Model\ResourceModel\JobsApplication $resourceModel,
        \Sandeep\Careers\Model\JobsApplicationFactory $modelFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;

    }

    /**
     * Public function for addJobsApplication Details
     *
     * @param array $data
     * @return mixed
     */
    public function addJobsApplication($data) {
        $model = $this->modelFactory->create();
        $model->setData('candidate_name', $data['candidate_name']);       
        $model->setData('candidate_email', $data['candidate_email']);       
        $model->setData('candidate_phone', $data['candidate_phone']);       
        $model->setData('applied_for', $data['applied_for']);       
        $model->setData('resume_path', $data['resume_path']);       
        $model->setData('status', $data['status']);       
        $saveData= $this->resourceModel->save($model);
        return $saveData;
    }
    /**
     * Public function for updateJobsApplication Details
     *
     * @param array $data
     * @return mixed
     */

    public function updateJobsApplication ($data)
    {
        $id = $data['application_id'];
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id, 'application_id');

        $model->setName($data['status']);  
        $saveData = $this->resourceModel->save($model);
        return $saveData;
    }
    /**
     * Public function for deleteJobsApplication Details
     *
     * @param string $id
     * @return mixed
     */
    public function deleteJobsApplication($id) {
        $model =  $this->modelFactory->create();
        $this->resourceModel->load($model,$id,'application_id');
        $saveData= $this->resourceModel->delete($model);
        return $saveData;
    }  
}