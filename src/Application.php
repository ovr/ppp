<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace PPP;

class Application extends \Symfony\Component\Console\Application
{
    public function __construct()
    {
        parent::__construct('ppp', 0.1);

        $this->add(new \PPP\Command\Run());
    }
}
