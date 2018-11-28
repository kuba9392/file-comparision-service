<?php
namespace Kuba9392;


class ArrayStorage
{
    private $storageData = [];

    public function getStorageData(): array
    {
        return $this->storageData;
    }

    public function setStorageData(array $storageData): void
    {
        $this->storageData = $storageData;
    }

    public function addToStorage($element)
    {
        $this->storageData[] = $element;
    }
}