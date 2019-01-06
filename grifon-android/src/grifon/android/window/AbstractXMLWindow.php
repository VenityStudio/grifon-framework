<?php

namespace grifon\android\window;


use php\android\R;
use php\android\view\View;

abstract class AbstractXMLWindow extends AbstractWindow
{
    /**
     * @return string
     */
    abstract public function getXMLId(): string;

    /**
     * @return View
     */
    public function makeUI(): View
    {
        $this->__activity->setContentViewById(R::layout($this->getXMLId()));

        return null;
    }
}