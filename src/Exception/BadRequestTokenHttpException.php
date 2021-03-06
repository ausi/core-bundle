<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Invalid request token exception.
 *
 * @author Christian Schiffler <https://github.com/discordier>
 */
class BadRequestTokenHttpException extends BadRequestHttpException
{
}
