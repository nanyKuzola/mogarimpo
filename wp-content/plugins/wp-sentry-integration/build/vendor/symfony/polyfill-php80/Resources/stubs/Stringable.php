<?php

namespace WPSentry\ScopedVendor;

interface Stringable
{
    /**
     * @return string
     */
    public function __toString();
}
\class_alias('WPSentry\\ScopedVendor\\Stringable', 'Stringable', \false);
