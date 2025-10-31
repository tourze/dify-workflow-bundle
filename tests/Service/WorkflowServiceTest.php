<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Tests\Service;

use HttpClientBundle\Client\ApiClient;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tourze\DifyWorkflowBundle\Request\GetWorkflowLogsRequest;
use Tourze\DifyWorkflowBundle\Request\StopWorkflowTaskRequest;
use Tourze\DifyWorkflowBundle\Request\WorkflowRunRequest;
use Tourze\DifyWorkflowBundle\Service\WorkflowService;

/**
 * @internal
 */
#[CoversClass(WorkflowService::class)]
final class WorkflowServiceTest extends TestCase
{
    private MockObject|ApiClient $apiClient;

    private WorkflowService $workflowService;

    protected function setUp(): void
    {
        $this->apiClient = $this->createMock(ApiClient::class);
        $this->workflowService = new WorkflowService($this->apiClient);
    }

    public function testRunWorkflow(): void
    {
        $inputs = ['key1' => 'value1'];
        $responseMode = 'blocking';
        $user = 'test-user';
        $expectedResponse = ['result' => 'success'];

        $this->apiClient
            ->expects(self::once())
            ->method('request')
            ->with(self::callback(static function (WorkflowRunRequest $request) use ($inputs, $responseMode, $user): bool {
                return $request->getInputs() === $inputs
                    && $request->getResponseMode() === $responseMode
                    && $request->getUser() === $user;
            }))
            ->willReturn($expectedResponse)
        ;

        $result = $this->workflowService->runWorkflow($inputs, $responseMode, $user);

        self::assertSame($expectedResponse, $result);
    }

    public function testGetWorkflowLogs(): void
    {
        $keyword = 'search-term';
        $status = 'completed';
        $page = 2;
        $limit = 50;
        $expectedResponse = ['logs' => []];

        $this->apiClient
            ->expects(self::once())
            ->method('request')
            ->with(self::callback(static function (GetWorkflowLogsRequest $request) use ($keyword, $status, $page, $limit): bool {
                return $request->getKeyword() === $keyword
                    && $request->getStatus() === $status
                    && $request->getPage() === $page
                    && $request->getLimit() === $limit;
            }))
            ->willReturn($expectedResponse)
        ;

        $result = $this->workflowService->getWorkflowLogs($keyword, $status, $page, $limit);

        self::assertSame($expectedResponse, $result);
    }

    public function testGetWorkflowLogsWithDefaults(): void
    {
        $expectedResponse = ['logs' => []];

        $this->apiClient
            ->expects(self::once())
            ->method('request')
            ->with(self::callback(static function (GetWorkflowLogsRequest $request): bool {
                return null === $request->getKeyword()
                    && null === $request->getStatus()
                    && 1 === $request->getPage()
                    && 20 === $request->getLimit();
            }))
            ->willReturn($expectedResponse)
        ;

        $result = $this->workflowService->getWorkflowLogs();

        self::assertSame($expectedResponse, $result);
    }

    public function testStopWorkflowTask(): void
    {
        $taskId = 'task-123';
        $user = 'test-user';
        $expectedResponse = ['status' => 'stopped'];

        $this->apiClient
            ->expects(self::once())
            ->method('request')
            ->with(self::callback(static function (StopWorkflowTaskRequest $request) use ($taskId, $user): bool {
                return $request->getTaskId() === $taskId
                    && $request->getUser() === $user;
            }))
            ->willReturn($expectedResponse)
        ;

        $result = $this->workflowService->stopWorkflowTask($taskId, $user);

        self::assertSame($expectedResponse, $result);
    }
}
