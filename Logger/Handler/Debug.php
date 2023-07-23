<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed Team (https://github.com/di-zed/)
 */
namespace DiZed\RepairableBase\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Custom logger handler for debug mode.
 */
class Debug extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/repairable/debug.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::DEBUG;
}
