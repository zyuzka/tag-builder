<?php

namespace TagBuilder;

use Symfony\Component\Yaml\Yaml;
use Exception;

class TagBuilderConfig
{
    /**
     * @var string
     */
    protected const ORGANISATION_ENV_NAME = 'ORGANISATION';

    /**
     * @var string
     */
    protected const TAGS_KEY = 'tags';

    /**
     * @var string
     */
    protected const DIRS_KEY = 'dirs';

    /**
     * @var string
     */
    protected const TAG_FORMAT_KEY = 'tag-format';

    /**
     * @var Yaml
     */
    private $yamlReader;
    /**
     * @var string
     */
    private $configFilePath;

    /**
     * @param string $configFilePath
     * @param Yaml $yamlReader
     */
    public function __construct(string $configFilePath, Yaml $yamlReader)
    {
        $this->configFilePath = $configFilePath;
        $this->yamlReader = $yamlReader;
    }

    /**
     * @return array
     */
    public function getTagsConfig(): array
    {
        return $this->yamlReader->parseFile($this->configFilePath)[static::TAGS_KEY] ?? [];
    }

    /**
     * @return array
     */
    public function getSearchDirs(): array
    {
        return $this->yamlReader->parseFile($this->configFilePath)[static::DIRS_KEY] ?? [APPLICATION_ROOT];
    }

    /**
     * @return string
     */
    public function getTagFormat(): string
    {
        return $this->yamlReader->parseFile($this->configFilePath)[static::TAG_FORMAT_KEY] ?? '';
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    function getOrganisationName(): string
    {
        $organisationName = getenv(static::ORGANISATION_ENV_NAME);

        if (!$organisationName) {
            throw new Exception(sprintf('Env variable `%s` is empty.', static::ORGANISATION_ENV_NAME));
        }

        return $organisationName;
    }
}
