<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\View;

use Zend\View\Model\ViewModel;
use ZF\Hal\Collection;
use ZF\Hal\Entity;



/**
 * Class WorkflowDescriptorApiModel
 *
 * @package OldTown\Workflow\Designer\Server\View
 */
class WorkflowDescriptorApiModel extends ViewModel
{
    /**
     * @param null $variables
     * @param null $options
     */
    public function __construct($variables = null, $options = null)
    {
        $this->terminate = true;
        parent::__construct($variables, $options);
    }


    /**
     * Property overloading: set variable value
     *
     * @param  string $name
     * @param  mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->setVariable($name, $value);
    }

    /**
     * Property overloading: get variable value
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        $value = null;
        $method = 'get' . ucfirst($name);
        $variables = $this->getVariables();
        if (method_exists($variables, $method)) {
            $value = call_user_func([$variables, $method]);
        }

        return $value;
    }

    /**
     * Property overloading: do we have the requested variable value?
     *
     * @param  string $name
     * @return bool
     */
    public function __isset($name)
    {
        $variables = $this->getVariables();
        $method = 'get' . ucfirst($name);
        $flag = method_exists($variables, $method);


        return $flag;
    }

    /**
     * Property overloading: unset the requested variable
     *
     * @param  string $name
     * @return void
     *
     * @throws Exception\BadMethodCallException
     */
    public function __unset($name)
    {
        $errMsg = 'Method not supported';
        throw new Exception\BadMethodCallException($errMsg);
    }

    /**
     * Does the payload represent a HAL collection?
     *
     * @return bool
     */
    public function isCollection()
    {
        $payload = $this->getPayload();
        return ($payload instanceof Collection);
    }

    /**
     * Does the payload represent a HAL entity?
     *
     * @return bool
     */
    public function isEntity()
    {
        $payload = $this->getPayload();
        return ($payload instanceof Entity);
    }

    /**
     * Set the payload for the response
     *
     * This is the value to represent in the response.
     *
     * @param  mixed $payload
     * @return self
     */
    public function setPayload($payload)
    {
        $this->setVariable('payload', $payload);
        return $this;
    }

    /**
     * Retrieve the payload for the response
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->getVariable('payload');
    }

    /**
     * Override setTerminal()
     *
     * Does nothing; does not allow re-setting "terminate" flag.
     *
     * @param  bool $flag
     * @return self
     */
    public function setTerminal($flag = true)
    {
        return $this;
    }
}
