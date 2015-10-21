<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\View\Exception;

use \OldTown\Workflow\Designer\Server\Exception\BadMethodCallException as Exception;

/**
 * Class InvalidArgumentException
 *
 * @package OldTown\Workflow\Designer\Server\View\Exception
 */
class BadMethodCallException extends Exception implements
    ExceptionInterface
{
}
