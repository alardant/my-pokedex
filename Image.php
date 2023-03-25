<?php

class Image
{
    private int $id;
    private string $name;
    private string $path;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // Permet d'hydrater l'ensemble des objets
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
                // a tester avec isset ?
            }
        }
    }

    //Getters and Setter

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
