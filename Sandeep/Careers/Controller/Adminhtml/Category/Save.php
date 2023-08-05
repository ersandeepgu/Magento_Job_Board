<?php


namespace Sandeep\Careers\Controller\Adminhtml\Category;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var Action\Context
     */
    public $context;

    /**
     * @var \ Sandeep\Careers\Helper\Category
     */
    public $helper;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param \ Sandeep\Careers\Helper\Category $helper
     */
    public function __construct(
        Context $context,
        \Sandeep\Careers\Helper\Category $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam("job_category_id");
        if($id) {
            $this->helper->updateCategory($data);
            $this->messageManager->addSuccess( __('Update Category Successfully') );
        } else{
            $this->helper->addCategory($data);
            $this->messageManager->addSuccess( __('Add Category Successfully !') );
        }
        return $this->resultRedirectFactory->create()->setPath('careers/category/index');

    }
}
