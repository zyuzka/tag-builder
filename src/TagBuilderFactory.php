<?php

namespace TagBuilder;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use TagBuilder\Action\ActionInterface;
use TagBuilder\Action\BuildAction;
use TagBuilder\Action\CheckAction;

class TagBuilderFactory
{
    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        $config = $this->createConfig();

        return [
            new BuildAction($config),
            new CheckAction($config, $this->createSymfonyFinder()),
        ];
    }

    /**
     * @return TagBuilderConfig
     */
    public function createConfig(): TagBuilderConfig
    {
        return new TagBuilderConfig($this->createSymfonyYaml());
    }

    /**
     * @return Yaml
     */
    public function createSymfonyYaml(): Yaml
    {
        return new Yaml();
    }

    /**
     * @return Finder
     */
    public function createSymfonyFinder(): Finder
    {
        return new Finder();
    }

}
