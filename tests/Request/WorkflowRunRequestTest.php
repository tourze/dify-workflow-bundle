<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyWorkflowBundle\Request\WorkflowRunRequest;

/**
 * @internal
 */
#[CoversClass(WorkflowRunRequest::class)]
final class WorkflowRunRequestTest extends RequestTestCase
{
    public function testConstructorAndGetters(): void
    {
        $inputs = ['key1' => 'value1', 'key2' => 'value2'];
        $responseMode = 'blocking';
        $user = 'test-user';

        $request = new WorkflowRunRequest($inputs, $responseMode, $user);

        self::assertSame($inputs, $request->getInputs());
        self::assertSame($responseMode, $request->getResponseMode());
        self::assertSame($user, $request->getUser());
    }

    public function testGetRequestPath(): void
    {
        $request = new WorkflowRunRequest([], 'blocking', 'test-user');

        self::assertSame('/workflows/run', $request->getRequestPath());
    }

    public function testGetRequestMethod(): void
    {
        $request = new WorkflowRunRequest([], 'blocking', 'test-user');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testGetRequestOptions(): void
    {
        $inputs = ['key1' => 'value1'];
        $responseMode = 'blocking';
        $user = 'test-user';

        $request = new WorkflowRunRequest($inputs, $responseMode, $user);

        $expectedOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'inputs' => $inputs,
                'response_mode' => $responseMode,
                'user' => $user,
            ],
        ];

        self::assertSame($expectedOptions, $request->getRequestOptions());
    }
}
