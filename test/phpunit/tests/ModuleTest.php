<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\PhpUnit\Test;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class ModuleTest
 *
 * @package OldTown\Workflow\Designer\Server\PhpUnit\Test
 */
class ModuleTest extends AbstractHttpControllerTestCase
{
    public function testLoadModule()
    {
        /** @noinspection PhpIncludeInspection */
        $this->setApplicationConfig(
            include Paths::getPathToAppConfig()
        );
        $this->assertModulesLoaded(['OldTown\Workflow\Designer\Server']);
    }
}
