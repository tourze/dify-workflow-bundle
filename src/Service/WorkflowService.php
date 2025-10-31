<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Service;

use HttpClientBundle\Client\ApiClient;
use HttpClientBundle\Request\ApiRequest;
use Tourze\DifyWorkflowBundle\Request\GetWorkflowLogsRequest;
use Tourze\DifyWorkflowBundle\Request\StopWorkflowTaskRequest;
use Tourze\DifyWorkflowBundle\Request\WorkflowRunRequest;

final class WorkflowService
{
    public function __construct(
        private readonly ApiClient $apiClient,
    ) {
    }

    /**
     * 执行工作流
     *
     * @param array<string, mixed> $inputs
     *
     * @return array<string, mixed>
     */
    public function runWorkflow(array $inputs, string $responseMode, string $user): array
    {
        $request = new WorkflowRunRequest($inputs, $responseMode, $user);

        return $this->sendRequest($request);
    }

    /**
     * 获取工作流日志
     *
     * @return array<string, mixed>
     */
    public function getWorkflowLogs(
        ?string $keyword = null,
        ?string $status = null,
        int $page = 1,
        int $limit = 20,
    ): array {
        $request = new GetWorkflowLogsRequest($keyword, $status, $page, $limit);

        return $this->sendRequest($request);
    }

    /**
     * 停止工作流任务
     *
     * @return array<string, mixed>
     */
    public function stopWorkflowTask(string $taskId, string $user): array
    {
        $request = new StopWorkflowTaskRequest($taskId, $user);

        return $this->sendRequest($request);
    }

    /**
     * @return array<string, mixed>
     */
    private function sendRequest(ApiRequest $request): array
    {
        $result = $this->apiClient->request($request);

        // 类型守卫：确保 API 返回数组
        if (!is_array($result)) {
            throw new \RuntimeException('API response must be an array');
        }

        /** @var array<string, mixed> $result */
        return $result;
    }
}
