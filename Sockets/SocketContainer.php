<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class SocketContainer
{
    private static $instance;
    private Collection $components;

    private function __construct()
    {
        $this->components = $this->load();
    }

    public static function getInstance(): self
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function load(): Collection
    {
        $components = collect();

        foreach (config('sockets.components') as $title => $namespace) {
            $components->put($title, new $namespace);
        }

        return $components;
    }

    private function __clone() {}

    public static function __callStatic($name, $arguments)
    {
        if (static::getInstance()->components->has($name)) {
            return static::getInstance()->components->get($name);
        }
    }

    public function get(string $componentName)
    {
        if ($this->components->has($componentName)) {
            return $this->components->get($componentName);
        }
    }
}
