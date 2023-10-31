<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen\Entities;

use Hyperf\CodeParser\Project;

class ClassConfig
{
    private string $namespace;
    private string $name;
    private string $stub;
    private ?string $suffix = null;
    private ?string $prefix = null;
    private array $run_previous = [];

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace =  str_replace(
            ['%CLASS%'],
            [$this->getName()],
            $namespace
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return str_replace('/', '', ltrim($this->name, '\\/'));
    }

    public function getVariableName(): string
    {
        return lcfirst($this->getName());
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return $this->stub;
    }

    /**
     * @param string $stub
     */
    public function setStub(string $stub): void
    {
        $this->stub = $stub;
    }

    /**
     * @return string|null
     */
    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * @param string|null $suffix
     */
    public function setSuffix(?string $suffix): void
    {
        $this->suffix = $suffix;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string|null $prefix
     */
    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getRunPrevious(): array
    {
        return $this->run_previous;
    }

    /**
     * @param array $run_previous
     */
    public function setRunPrevious(array $run_previous): void
    {
        $this->run_previous = $run_previous;
    }

    public function getSanitizedClassName(): string
    {
        $name = $this->getPrefix() . $this->getName() . $this->getSuffix();
        return str_replace('/', '', ltrim($name, '\\/'));
    }

    public function getQualifyClass(): string
    {
        return $this->getNamespace() . '\\' . $this->getSanitizedClassName();
    }

    public function getClassPath(): string
    {
        $project = new Project();
        return $project->path($this->getQualifyClass());
    }

    public static function fromArray(array $attributes = []): ClassConfig
    {
        $classConfig = new ClassConfig();
        $classConfig->setName($attributes['name']);
        $classConfig->setNamespace($attributes['namespace']);
        $classConfig->setStub($attributes['stub']);
        $classConfig->setPrefix($attributes['prefix'] ?? null);
        $classConfig->setSuffix($attributes['suffix'] ?? null);
        $classConfig->setRunPrevious($attributes['run_previous'] ?? []);
        return $classConfig;
    }
}
