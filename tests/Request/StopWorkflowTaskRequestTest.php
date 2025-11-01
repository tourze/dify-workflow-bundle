<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyWorkflowBundle\Request\StopWorkflowTaskRequest;

/**
 * @internal
 */
#[CoversClass(StopWorkflowTaskRequest::class)]
final class StopWorkflowTaskRequestTest extends RequestTestCase
{
    public function testConstructorAndGetters(): void
    {
        $taskId = 'task-123';
        $user = 'test-user';

        $request = new StopWorkflowTaskRequest($taskId, $user);

        self::assertSame($taskId, $request->getTaskId());
        self::assertSame($user, $request->getUser());
    }

    public function testGetRequestPath(): void
    {
        $taskId = 'task-123';
        $request = new StopWorkflowTaskRequest($taskId, 'test-user');

        self::assertSame("/workflows/tasks/{$taskId}/stop", $request->getRequestPath());
    }

    public function testGetRequestMethod(): void
    {
        $request = new StopWorkflowTaskRequest('task-123', 'test-user');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testGetRequestOptions(): void
    {
        $taskId = 'task-123';
        $user = 'test-user';

        $request = new StopWorkflowTaskRequest($taskId, $user);

        $expectedOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'user' => $user,
            ],
        ];

        self::assertSame($expectedOptions, $request->getRequestOptions());
    }
}
