<?php

namespace TagBuilder;

use Symfony\Component\Yaml\Yaml;
use Exception;

class TagBuilderConfig
{
    /**
     * @var string
     */
    protected const CONFIG_FILE_PATH = APPLICATION_ROOT . '/config.yml';

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
     * @param Yaml $yamlReader
     */
    public function __construct(Yaml $yamlReader)
    {
        $this->yamlReader = $yamlReader;
    }

    /**
     * @return array
     */
    public function getTagsConfig(): array
    {
        return $this->yamlReader->parseFile(static::CONFIG_FILE_PATH)[static::TAGS_KEY] ?? [];
    }

    /**
     * @return array
     */
    public function getSearchDirs(): array
    {
        return $this->yamlReader->parseFile(static::CONFIG_FILE_PATH)[static::DIRS_KEY] ?? [APPLICATION_ROOT];
    }

    /**
     * @return string
     */
    public function getTagFormat(): string
    {
        return $this->yamlReader->parseFile(static::CONFIG_FILE_PATH)[static::TAG_FORMAT_KEY] ?? '';
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
