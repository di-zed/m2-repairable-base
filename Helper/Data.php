<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed Team (https://github.com/di-zed/)
 */
namespace DiZed\RepairableBase\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

/**
 * Helper Data.
 */
class Data extends AbstractHelper
{
    /**
     * Path for the module status.
     */
    const XML_PATH_ENABLED = 'dized_repairable_base/general/enabled';

    /**
     * Path for the "API Public Key" value.
     */
    const XML_PATH_API_PUBLIC_KEY = 'dized_repairable_base/general/api_public_key';

    /**
     * Path for the "API Private Key" value.
     */
    const XML_PATH_API_PRIVATE_KEY = 'dized_repairable_base/general/api_private_key';

    /**
     * @var EncryptorInterface
     */
    protected EncryptorInterface $encryptor;

    /**
     * Helper constructor.
     *
     * @param Context $context
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        EncryptorInterface $encryptor
    ) {
        parent::__construct($context);

        $this->encryptor = $encryptor;
    }

    /**
     * Is module enabled?
     *
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get API Public Key.
     *
     * @return string
     */
    public function getApiPublicKey(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_API_PUBLIC_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get API Private Key.
     *
     * @return string
     */
    public function getApiPrivateKey(): string
    {
        $value = (string)$this->scopeConfig->getValue(self::XML_PATH_API_PRIVATE_KEY, ScopeInterface::SCOPE_STORE);
        return $this->encryptor->decrypt($value);
    }

    /**
     * Get logger.
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->_logger;
    }
}
