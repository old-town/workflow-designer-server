<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor;

use OldTown\Workflow\Loader\WorkflowDescriptor;
use Zend\Stdlib\JsonSerializable;

/**
 * Class WorkflowDescriptorEntity
 *
 * @package OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor
 */
class WorkflowDescriptorEntity extends WorkflowDescriptor implements JsonSerializable
{
    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @return array()
     */
    public function jsonSerialize()
    {
        return [];
    }
}