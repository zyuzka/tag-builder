<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TagBuilder\Action;

use Exception;
use TagBuilder\TagBuilderConfig;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var string
     */
    protected const ACTION_NAME = '';

    /**
     * @var TagBuilderConfig
     */
    protected $config;

    /**
     * @param TagBuilderConfig $config
     */
    public function __construct(TagBuilderConfig $config)
    {
        $this->config = $config;
        $this->config = $config;
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    public function getName(): string
    {
        if (static::ACTION_NAME == '') {
            throw new Exception('ACTION_NAME shouldn\'t be empty.');
        }

        return static::ACTION_NAME;
    }
}
