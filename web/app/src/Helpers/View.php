<?php

namespace App\Helpers;

class View
{
    private const VIEW_PATH = __DIR__ . '/../Templates/';

    public function __construct(
        readonly private string $view,
        readonly private array $params = []
    )
    {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static ($view, $params);
    }

    public function render(): string
    {
        $viewPath = self::VIEW_PATH . $this->view . '.php';

        ob_start();

        include $viewPath;

        return (string)ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }

}