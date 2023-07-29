<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed Team (https://github.com/di-zed/)
 */
namespace DiZed\RepairableBase\Block\Form;

use DiZed\RepairableBase\Helper\Data;
use DiZed\RepairableBase\Model\Client\Form;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block for the main Repairable form.
 */
class Widget extends Template
{
    /**
     * @inheritDoc
     */
    protected $_template = 'DiZed_RepairableBase::form/widget.phtml';

    /**
     * @var Form
     */
    protected Form $client;

    /**
     * @var Data
     */
    protected Data $helper;

    /**
     * @var string|null
     */
    private ?string $formHtml = null;

    /**
     * Block constructor.
     *
     * @param Context $context
     * @param Form $client
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Form $client,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->client = $client;
        $this->helper = $helper;
    }

    /**
     * Get form HTML code.
     *
     * @return string
     */
    public function getFormHtml(): string
    {
        if ($this->formHtml === null) {
            try {
                if ($client = $this->client->getClient()) {
                    $this->formHtml = $client->getFormHtml();
                } else {
                    $this->formHtml = '';
                }
            } catch (\Exception $e) {
                $this->formHtml = '';
                $this->helper->getLogger()->error($e->getMessage());
            }
        }

        return $this->formHtml;
    }

    /**
     * @inheritDoc
     */
    protected function _toHtml(): string
    {
        if (!$this->helper->isModuleEnabled()) {
            return '';
        }
        if (!$this->getFormHtml()) {
            return '';
        }

        return parent::_toHtml();
    }
}
