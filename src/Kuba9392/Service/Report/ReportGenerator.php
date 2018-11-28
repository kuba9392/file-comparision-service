<?php


namespace Kuba9392\Service\Report;

class ReportGenerator
{
    /**
     * @var ReportGenerateStrategy[]
     */
    private $strategies;

    public function generate()
    {
        foreach($this->strategies as $strategy) {
            $strategy->generate();
        }
    }

    public function getStrategies(): array
    {
        return $this->strategies;
    }

    public function setStrategies(array $strategies): self
    {
        $this->strategies = $strategies;
        return $this;
    }

    public function addStrategy(ReportGenerateStrategy $strategy): self
    {
        $this->strategies[] = $strategy;
        return $this;
    }
}