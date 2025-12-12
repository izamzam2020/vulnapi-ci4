<?php

namespace Config;

use CodeIgniter\Config\Publisher as BasePublisher;

/**
 * Publisher Configuration
 */
class Publisher extends BasePublisher
{
    /**
     * Restrictions
     */
    public $restrictions = [
        ROOTPATH => '*',
        FCPATH   => '#\.(s?css|js|map|html?|xml|json|webmanifest|ttf|eot|woff2?|gif|jpe?g|tiff?|png|webp|bmp|ico|svg)$#i',
    ];
}

