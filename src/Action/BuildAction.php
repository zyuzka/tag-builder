<?php

namespace TagBuilder\Action;

use Exception;

class BuildAction extends AbstractAction
{
    /**
     * @var string
     */
    protected const ACTION_NAME = 'build';

    /**
     * @var string
     */
    protected const TAGS_KEY = 'tags';

    /**
     * @var string
     */
    protected const FILE_KEY = 'file';

    /**
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $tagMatrix = [];

        foreach ($this->config->getTagsConfig() as $dockerfilePath => $tags) {
            $tagMatrix[] = $this->buildImageMatrix($dockerfilePath, $tags);
        }

        echo json_encode($tagMatrix);
    }

    protected function buildImageMatrix($dockerfilePath, $tags): array
    {
        if (!file_exists($dockerfilePath)) {
            throw new Exception(sprintf('`%s` file isn\'t exist.', $dockerfilePath));
        }

        if ($tags == []) {
            throw new Exception(sprintf('`%s` file doesn\'t have any tags.', $dockerfilePath));
        }

        if ($this->config->getTagFormat() == '') {
            throw new Exception(sprintf('Tag format should be configured into config file.', $dockerfilePath));
        }

        $imageMatrix = [];

        $imageMatrix[static::FILE_KEY] = $dockerfilePath;

        foreach ($tags as $tag) {
            $imageMatrix[static::TAGS_KEY][] = sprintf($this->config->getTagFormat(), $this->config->getOrganisationName(), $tag);
        }

        return $imageMatrix;
    }
}
