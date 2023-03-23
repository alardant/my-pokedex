<?php

class Pokemon
{
    private int $id;
    private int $number;
    private string $name;
    private string $description;
    private int $type1;
    private int $type2;

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
                // a tester avec isset
            }
        }
    }

    // Getters and Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        if (is_int($number)) {
            $this->number = $number;
        }
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        if (is_string($description) && strlen($description) < 1000) {
            $this->description = $description;
        }
        return $this;
    }

    public function getType1(): int
    {
        return $this->type1;
    }

    public function setType1(int $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): int
    {
        return $this->type2;
    }

    public function setType2(int $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }
}
