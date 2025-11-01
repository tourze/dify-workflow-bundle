<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyWorkflowBundle\Request\GetWorkflowLogsRequest;

/**
 * @internal
 */
#[CoversClass(GetWorkflowLogsRequest::class)]
final class GetWorkflowLogsRequestTest extends RequestTestCase
{
    public function testConstructorWithDefaults(): void
    {
        $request = new GetWorkflowLogsRequest();

        self::assertNull($request->getKeyword());
        self::assertNull($request->getStatus());
        self::assertSame(1, $request->getPage());
        self::assertSame(20, $request->getLimit());
    }

    public function testConstructorWithCustomValues(): void
    {
        $keyword = 'search-term';
        $status = 'completed';
        $page = 2;
        $limit = 50;

        $request = new GetWorkflowLogsRequest($keyword, $status, $page, $limit);

        self::assertSame($keyword, $request->getKeyword());
        self::assertSame($status, $request->getStatus());
        self::assertSame($page, $request->getPage());
        self::assertSame($limit, $request->getLimit());
    }

    public function testGetRequestPath(): void
    {
        $request = new GetWorkflowLogsRequest();

        self::assertSame('/workflows/logs', $request->getRequestPath());
    }

    public function testGetRequestMethod(): void
    {
        $request = new GetWorkflowLogsRequest();

        self::assertSame('GET', $request->getRequestMethod());
    }

    public function testGetRequestOptionsWithDefaults(): void
    {
        $request = new GetWorkflowLogsRequest();

        $expectedOptions = [
            'query' => [],
        ];

        self::assertSame($expectedOptions, $request->getRequestOptions());
    }

    public function testGetRequestOptionsWithCustomValues(): void
    {
        $keyword = 'search-term';
        $status = 'completed';
        $page = 3;
        $limit = 30;

        $request = new GetWorkflowLogsRequest($keyword, $status, $page, $limit);

        $expectedOptions = [
            'query' => [
                'keyword' => $keyword,
                'status' => $status,
                'page' => $page,
                'limit' => $limit,
            ],
        ];

        self::assertSame($expectedOptions, $request->getRequestOptions());
    }
}
