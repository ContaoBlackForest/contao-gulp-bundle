<?php

/**
 * This file is part of contaoblackforest/contao-gulp-bundle.
 *
 * (c) 2014-2018 The ContaoBlackForest team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    contaoblackforest/contao-gulp-bundle
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2014-2018 The ContaoBlackForest team.
 * @license    hhttps://github.com/ContaoBlackForest/contao-gulp-bundle/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace ContaoBlackForest\GulpBundle\Test;

use ContaoBlackForest\GulpBundle\ContaoBlackForestContaoGulpBundle;
use ContaoBlackForest\GulpBundle\DependencyInjection\ContaoBlackForestContaoGulpExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Resource\ComposerResource;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ContaoBlackForestContaoGulpBundleTest
 *
 * @covers \ContaoBlackForest\GulpBundle\ContaoBlackForestContaoGulpBundle
 */
class ContaoBlackForestContaoGulpBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoBlackForestContaoGulpBundle();

        $this->assertInstanceOf(ContaoBlackForestContaoGulpBundle::class, $bundle);
    }

    public function testReturnsTheContainerExtension()
    {
        $extension = (new ContaoBlackForestContaoGulpBundle())->getContainerExtension();

        $this->assertInstanceOf(ContaoBlackForestContaoGulpExtension::class, $extension);
    }

    /**
     * @covers \ContaoBlackForest\GulpBundle\DependencyInjection\ContaoBlackForestContaoGulpExtension::load
     */
    public function testLoadExtensionConfiguration()
    {
        $extension = (new ContaoBlackForestContaoGulpBundle())->getContainerExtension();
        $container = new ContainerBuilder();

        $extension->load([], $container);

        $this->assertInstanceOf(ComposerResource::class, $container->getResources()[0]);
        $this->assertInstanceOf(FileResource::class, $container->getResources()[1]);
        $this->assertSame(
            \dirname(\dirname(__DIR__)) . '/src/Resources/config/services.yml',
            $container->getResources()[1]->getResource()
        );
    }
}
