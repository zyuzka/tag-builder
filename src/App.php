<?php

namespace TagBuilder;

use TagBuilder\Arguments\ArgumentBuilder;

class App
{
    /**
     * @var array
     */
    private const ERROR_MSG = 'Need to choose one action:' . PHP_EOL;

    /**
     * @var TagBuilderFactory;
     */
    private $factory;

    public function __construct()
    {
        $this->factory = new TagBuilderFactory();
    }

    /**
     * @param array $arguments
     *
     * @return void
     */
    public function run(array $arguments): void
    {
        $argumentCollection = (new ArgumentBuilder())->build($arguments);

        $this->configureApplication($argumentCollection);

        $actionNames = [];

        foreach ($this->factory->getActions() as $action) {
            if ($action->getName() == $argumentCollection[TagBuilderConstants::ACTION_KEY]) {
                $action->run();

                return;
            }

            $actionNames[] = $action->getName();
        }

        echo $this->getErrorMessage($actionNames);
    }

    /**
     * @param array $actionNames
     *
     * @return string
     */
    protected function getErrorMessage(array $actionNames): string
    {
        $errorMessege = static::ERROR_MSG;

        foreach ($actionNames as $actionName) {
            $errorMessege .= ' * ' . $actionName . PHP_EOL;
        }

        return $errorMessege;
    }

    /**
     * @param array $argumentCollection
     *
     * @return void
     */
    protected function configureApplication(array $argumentCollection): void
    {
        $this->factory = new TagBuilderFactory();

        $config = new TagBuilderConfig(
            $argumentCollection[TagBuilderConstants::CONFIG_FILE_PATH_KEY],
            $this->factory->createSymfonyYaml()
        );

        $this->factory = $this->factory->setConfig($config);
    }
}
