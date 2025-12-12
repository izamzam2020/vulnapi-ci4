<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Feature Flags Configuration
 */
class Feature extends BaseConfig
{
    /**
     * Use improved auto routing
     */
    public bool $autoRoutesImproved = true;

    /**
     * Use filter execution order
     */
    public bool $oldFilterOrder = false;

    /**
     * Use limit zero
     */
    public bool $limitZeroAsAll = true;
}

