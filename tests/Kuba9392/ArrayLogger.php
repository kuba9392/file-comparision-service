<?php
namespace Kuba9392;

use Kuba9392\Service\Logger\Logger;

class ArrayLogger implements Logger
{
    /**
     * @var ArrayStorage
     */
    private $storage;

    public function __construct(ArrayStorage $storage)
    {
        $this->storage = $storage;
    }

    public function log(string $content, ...$args)
    {
        $this->storage->addToStorage($content);
    }
}