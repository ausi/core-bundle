<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Test\EventListener;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\CoreBundle\EventListener\ScopeAwareListener;
use Contao\CoreBundle\Test\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Scope;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Tests the ScopeAwareListener class.
 *
 * @author Leo Feyer <https:/github.com/leofeyer>
 */
class ScopeAwareListenerTest extends TestCase
{
    /**
     * @var ScopeAwareListener
     */
    private $listener;

    /**
     * Tests the object instantiation.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->listener = $this->getMockForAbstractClass('Contao\\CoreBundle\\EventListener\\ScopeAwareListener');
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\\CoreBundle\\EventListener\\ScopeAwareListener', $this->listener);
    }

    /**
     * Tests the isFrontendMasterRequest() method.
     */
    public function testIsFrontendMasterRequest()
    {
        $container = new ContainerBuilder();
        $container->addScope(new Scope(ContaoCoreBundle::SCOPE_FRONTEND));
        $container->enterScope(ContaoCoreBundle::SCOPE_FRONTEND);

        $this->listener->setContainer($container);

        $event = new KernelEvent($this->mockKernel(), new Request(), HttpKernelInterface::MASTER_REQUEST);

        $reflection = new \ReflectionClass($this->listener);
        $method = $reflection->getMethod('isFrontendMasterRequest');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->listener, [$event]));
    }

    /**
     * Tests the isBackendMasterRequest() method.
     */
    public function testIsBackendMasterRequest()
    {
        $container = new ContainerBuilder();
        $container->addScope(new Scope(ContaoCoreBundle::SCOPE_BACKEND));
        $container->enterScope(ContaoCoreBundle::SCOPE_BACKEND);

        $this->listener->setContainer($container);

        $event = new KernelEvent($this->mockKernel(), new Request(), HttpKernelInterface::MASTER_REQUEST);

        $reflection = new \ReflectionClass($this->listener);
        $method = $reflection->getMethod('isBackendMasterRequest');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->listener, [$event]));
    }
}
