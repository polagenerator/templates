<?php

declare(strict_types=1);

namespace Pola\Templates;

use Latte\Engine;

class LatteRenderer implements TemplateInterface
{
    private Engine $engine;

    public function __construct(
        public string $templatesDir,
        public string $cacheDir,
        public bool $autoRefresh = true
    ) {
        $this->engine = new Engine();
        $this->engine->setAutoRefresh(state: $autoRefresh);
        $this->engine->setTempDirectory(path: $cacheDir);
    }

    /**
     * @inheritDoc
     */
    public function render(string $template, array $data = []): string
    {
        $path = rtrim(string: $this->templatesDir, characters: DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $template;

        if (!file_exists(filename: $path)) {
            throw new \RuntimeException(message: "Template not found: {$path}");
        }

        return $this->engine->renderToString(name: $path, params: $data);
    }
}
