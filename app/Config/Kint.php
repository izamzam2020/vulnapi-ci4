<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Kint Configuration (Debug tool)
 */
class Kint extends BaseConfig
{
    public $plugins = null;
    public int $maxDepth = 6;
    public bool $displayCalledFrom = true;
    public bool $expanded = false;

    public ?string $richTheme = null;
    public bool $richFolder = false;
    public ?int $richSort = null;
    public ?string $richObjectPlugins = null;
    public ?string $richTabPlugins = null;

    public bool $cliColors = true;
    public bool $cliForceUTF8 = false;
    public bool $cliDetectWidth = true;
    public int $cliMinWidth = 40;
}
