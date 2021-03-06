<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\EventListener;

use Contao\Frontend;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

/**
 * Adds a page to the search index after the response has been sent.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class AddToSearchIndexListener
{
    /**
     * Forwards the request to the Frontend class if there is a page object.
     *
     * @param PostResponseEvent $event The event object
     */
    public function onKernelTerminate(PostResponseEvent $event)
    {
        // FIXME: should be replaced with "Response implements Indexable" (see https://github.com/contao/symfony-todo/issues/3)
        if (!defined('TL_ROOT')) {
            return;
        }

        Frontend::indexPageIfApplicable($event->getResponse());
    }
}
