<?php

declare(strict_types=1);

namespace Pola\Templates;

interface TemplateInterface
{
    public function render(string $template, array $data = []): string;
}