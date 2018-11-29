<?php

use packager\Event;
use packager\cli\Console;

function task_build(Event $e)
{
    foreach ($e->package()->getAny("modules") as $module)
    	Tasks::runExternal('./grifon-' . $module, 'publish', [], "yes");
}

function task_test(Event $e)
{
    foreach ($e->package()->getAny("modules") as $module)
    	Tasks::runExternal('./grifon-' . $module, 'install', [], "yes");
    
    foreach ($e->package()->getAny("modules") as $module)
    	Tasks::runExternal('./grifon-' . $module, 'test', [], "yes");
}

function task_publish(Event $e)
{
    Tasks::run('build', [], ...$e->flags());
}
