<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

/**
 * Sends an empty response and stops the program flow.
 *
 * @author Christian Schiffler <https://github.com/discordier>
 */
class NoContentResponseException extends AbstractResponseException
{
    /**
     * Constructor.
     *
     * @param int   $status  The response status code (defaults to 204)
     * @param array $headers An array of response headers
     */
    public function __construct($status = 204, $headers = [])
    {
        parent::__construct(new Response('', $status, $headers));
    }
}
