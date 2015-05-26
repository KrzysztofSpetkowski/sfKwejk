<?php

namespace Kwejk\MemsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KwejkMemsBundle extends Bundle
{
    public function getParent() 
    {
        return 'FOSUSERBundle';
    }
}
