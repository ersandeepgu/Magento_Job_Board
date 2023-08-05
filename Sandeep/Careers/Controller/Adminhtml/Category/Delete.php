<?php


namespace Sandeep\Careers\Controller\Adminhtml\Category;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

class Delete extends Action
{
    /**
     * @var Action\Context
     */
    public $context;

    /**
     * @var \Sandeep\Careers\Helper\Category
     */
    public $helper;

    /**
     * Constructor.
     *
     * @param Action\Context $context
     * @param \Sandeep\Careers\Helper\Category $helper
     */
    public function __construct(
        Action\Context $context,
        \Sandeep\Careers\Helper\Category $helper
    ){
        parent::__construct($context);
        $this->helper= $helper;
    }

    /**
     * Public function for execute methods
     *
     * @return mixed
     */
    public function execute(){
        $id = $this->getRequest()->getParam("job_category_id");
        $this->helper->deleteCategory($id);
        $this->messageManager->addSuccess( __('Category Deleted Successfully !') );
        return $this->resultRedirectFactory->create()->setPath('careers/category/index');
    }
}
?>





