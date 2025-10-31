<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\DifyWorkflowBundle\DifyWorkflowBundle;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;

/**
 * @internal
 */
#[CoversClass(DifyWorkflowBundle::class)]
#[RunTestsInSeparateProcesses]
final class DifyWorkflowBundleTest extends AbstractBundleTestCase
{
}
