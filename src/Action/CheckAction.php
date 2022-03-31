<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TagBuilder\Action;

use Symfony\Component\Finder\Finder;
use TagBuilder\TagBuilderConfig;

class CheckAction extends AbstractAction
{
    /**
     * @var string
     */
    protected const ACTION_NAME = 'check';

    /**
     * @var Finder
     */
    protected $finder;

    public function __construct(TagBuilderConfig $config, Finder $finder)
    {
        parent::__construct($config);

        $this->finder = $finder;
    }

    public function run(): void
    {
        $message = 'Untagged images:' . PHP_EOL;

        foreach ($this->finder->in($this->config->getSearchDirs())->files()->name('Dockerfile') as $file) {
            if (!array_key_exists($file->getPathname(), $this->config->getTagsConfig())) {
                $message .= ' * ' . $file->getRealPath() . PHP_EOL;
            }
        }

        echo $message;
    }
}
