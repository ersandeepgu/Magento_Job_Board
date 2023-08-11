<?php
namespace Sandeep\Careers\Block\Adminhtml\JobsApplication\Edit\Renderer;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Button;

class DownloadLink extends \Magento\Backend\Block\Widget\Button
{
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->setData($data);
    }

    public function _toHtml()
    {
        return $this->getLayout()->createBlock(Template::class)
            ->setTemplate('Sandeep_Careers::download_link.phtml')
            ->toHtml();
    }
    public function getDownloadUrl()
    {
        $applicationId = $this->getData('application_id');
        $url = $this->getUrl('careers/jobsapplication/download', ['application_id' => $applicationId]);

        $html = '<a href="' . $url . '" target="_blank">Download Resume</a>';
        return $html;
    }


}
