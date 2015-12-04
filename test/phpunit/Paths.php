<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\PhpUnit\Test;

/**
 * Class Paths
 *
 * @package OldTown\Workflow\Designer\Server\PhpUnit\Test
 */
class Paths
{
    /**
     * Путь до конфига приложения
     *
     * @var string|null
     */
    protected static $pathToAppConfig;


    /**
     * Возвращает путь до директории с данными для тестов
     *
     * @return string
     */
    public static function getPathToAppConfig()
    {
        if (static::$pathToAppConfig) {
            return static::$pathToAppConfig;
        }

        static::$pathToAppConfig =   __DIR__ . '/_files/app/application.config.php';

        return static::$pathToAppConfig;
    }

    /**
     * Путь до директории где находится файл инициирующий приложение
     *
     * @return string
     */
    public static function getPathToModule()
    {
        return __DIR__ . '/../../';
    }
}
