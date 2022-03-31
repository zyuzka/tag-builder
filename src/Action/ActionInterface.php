<?php

namespace TagBuilder\Action;

interface ActionInterface
{
    /**
     * @return void
     */
    public function run(): void;

    /**
     * @return string
     */
    public function getName(): string;
}
