<?php

namespace TagBuilder;

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
     * @param string $actionName
     *
     * @return void
     */
    public function run(string $actionName): void
    {
        $actionNames = [];

        foreach ($this->factory->getActions() as $action) {
            if ($action->getName() == $actionName) {
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
            $errorMessege.= ' * ' . $actionName . PHP_EOL;
        }

        return $errorMessege;
    }
}
