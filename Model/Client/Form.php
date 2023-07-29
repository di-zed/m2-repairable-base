<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed Team (https://github.com/di-zed/)
 */
namespace DiZed\RepairableBase\Model\Client;

use DiZed\RepairableBase\Helper\Data;
use DiZed\RepairableClient\Client\FormClient;

/**
 * Form Client.
 */
class Form
{
    /**
     * @var FormClient|null
     */
    protected ?FormClient $client = null;

    /**
     * @var Data
     */
    protected Data $helper;

    /**
     * Client constructor.
     *
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;

        $this->initClient();
    }

    /**
     * Get Client.
     *
     * @return FormClient|null
     */
    public function getClient(): ?FormClient
    {
        return $this->client;
    }

    /**
     * Client initialization.
     *
     * @return FormClient|null
     */
    protected function initClient(): ?FormClient
    {
        if (!$this->client) {
            if (!$publicKey = $this->helper->getApiPublicKey()) {
                $this->helper->getLogger()->error('Public Key is undefined.');
                $this->client = null;
                return null;
            }
            if (!$privateKey = $this->helper->getApiPrivateKey()) {
                $this->helper->getLogger()->error('Private Key is undefined.');
                $this->client = null;
                return null;
            }
            $this->client = new FormClient($publicKey, $privateKey);
        }

        return $this->client;
    }
}
