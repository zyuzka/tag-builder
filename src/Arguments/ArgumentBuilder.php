<?php


namespace TagBuilder\Arguments;

use Exception;
use TagBuilder\TagBuilderConstants;

class ArgumentBuilder
{
    protected const CONFIG_ARGUMENT_KEY = '-c';
    protected const ACTION_ARGUMENT_KEY = '-a';

    /**
     * @param array $arguments
     *
     * @return array
     * @throws Exception
     */
    public function build(array $arguments): array
    {
        return [
            TagBuilderConstants::ACTION_KEY => $this->getAction($arguments),
            TagBuilderConstants::CONFIG_FILE_PATH_KEY => $this->getConfigFile($arguments),
        ];
    }

    /**
     * @param array $arguments
     *
     * @return string
     * @throws Exception
     */
    protected function getConfigFile(array $arguments): string
    {
        $key = array_search(static::CONFIG_ARGUMENT_KEY, $arguments);

        if (!$key) {
            throw new Exception('Please provide config file path to script with `-c`.');
        }

        return $arguments[$key + 1];
    }

    /**
     * @param array $arguments
     *
     * @return string
     * @throws Exception
     */
    protected function getAction(array $arguments): string
    {
        $key = array_search(static::ACTION_ARGUMENT_KEY, $arguments);

        if (!$key) {
            throw new Exception('Please action to script with `-a`.');
        }

        return $arguments[$key + 1];
    }
}
