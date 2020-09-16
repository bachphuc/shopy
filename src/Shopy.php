<?php

namespace bachphuc\Shopy;

use bachphuc\Shopy\Version;

class Shopy
{
    protected $version = null;

    public function __construct(Version $version)
    {   
        $this->version = $version;
    }

    public function view($path, $data = [])
    {
        return view('bachphuc.shopy::' . $path, $data);        
    }
}