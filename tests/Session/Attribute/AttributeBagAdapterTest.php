<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Test\Session\Attribute;

use Contao\CoreBundle\Session\Attribute\AttributeBagAdapter;
use Contao\CoreBundle\Test\TestCase;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

/**
 * Tests the AttributeBagAdapter class.
 *
 * @author Yanick Witschi <https://github.com/toflar>
 */
class AttributeBagAdapterTest extends TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $adapter = new AttributeBagAdapter(new AttributeBag('foobar_storageKey'));

        $this->assertInstanceOf('Contao\\CoreBundle\\Session\\Attribute\\AttributeBagAdapter', $adapter);
        $this->assertInstanceOf('ArrayAccess', $adapter);
    }

    /**
     * Tests the offsetSet() method.
     */
    public function testOffsetSet()
    {
        $attributeBag = new AttributeBag('foobar_storageKey');
        $adapter      = new AttributeBagAdapter($attributeBag);

        $adapter['foo'] = 'bar';

        $this->assertSame('bar', $attributeBag->get('foo'));
    }

    /**
     * Tests the offsetExists() method.
     */
    public function testOffsetExists()
    {
        $attributeBag = new AttributeBag('foobar_storageKey');
        $adapter      = new AttributeBagAdapter($attributeBag);

        $adapter['foo'] = 'bar';

        $this->assertTrue(isset($adapter['foo']));
    }

    /**
     * Tests the offsetGet() method.
     */
    public function testOffsetGet()
    {
        $attributeBag = new AttributeBag('foobar_storageKey');
        $adapter      = new AttributeBagAdapter($attributeBag);

        $attributeBag->set('foo', 'bar');

        $this->assertSame('bar', $adapter['foo']);
    }

    /**
     * Tests the offsetUnset() method.
     */
    public function testOffsetUnset()
    {
        $attributeBag = new AttributeBag('foobar_storageKey');
        $adapter      = new AttributeBagAdapter($attributeBag);

        $attributeBag->set('foo', 'bar');

        unset($adapter['foo']);

        $this->assertFalse($attributeBag->has('foo'));
    }
}
