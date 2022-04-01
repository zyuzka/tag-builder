<?php

namespace TagBuilder;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use TagBuilder\Action\ActionInterface;
use TagBuilder\Action\BuildAction;
use TagBuilder\Action\CheckAction;
use TagBuilder\Arguments\ArgumentBuilder;
use TagBuilder\Arguments\ArgumentBuilderInterface;

class TagBuilderFactory
{
    private $config;

    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        $config = $this->getConfig();

        return [
            new BuildAction($config),
            new CheckAction($config, $this->createSymfonyFinder()),
        ];
    }

    /**
     * @return TagBuilderConfig
     */
    public function getConfig(): TagBuilderConfig
    {
        return $this->config;
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

    /**
     * @param TagBuilderConfig $config
     *
     * @return TagBuilderFactory
     */
    public function setConfig(TagBuilderConfig $config): self
    {
        $this->config = $config;

        return $this;
    }

}
