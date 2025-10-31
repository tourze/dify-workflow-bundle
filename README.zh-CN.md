# Dify 工作流包

[English](README.md) | [中文](README.zh-CN.md)

用于 Dify AI 工作流执行、任务管理和日志记录的 Symfony Bundle。

## 功能特性

- **工作流执行**：执行 Dify 工作流并传递参数
- **任务管理**：监控和控制工作流任务
- **日志系统**：全面的工作流执行日志记录
- **状态跟踪**：实时工作流和任务状态监控
- **停止控制**：能够停止正在运行的工作流任务

## 安装

```bash
composer require tourze/dify-workflow-bundle
```

## 配置

将 bundle 添加到 `config/bundles.php`：

```php
return [
    // ... 其他 bundles
    Tourze\DifyWorkflowBundle\DifyWorkflowBundle::class => ['all' => true],
];
```

## API 端点

- **执行工作流**：启动带参数的工作流执行
- **获取工作流日志**：检索详细的执行日志
- **停止工作流任务**：终止正在运行的工作流任务

## 使用方法

```php
// 执行工作流
$workflowService->executeWorkflow($appId, $userId, $inputs);

// 获取工作流日志
$logs = $workflowService->getWorkflowLogs($workflowId);

// 停止工作流任务
$workflowService->stopWorkflowTask($taskId);
```

## 系统要求

- PHP 8.1+
- Symfony 7.3+
- tourze/dify-core-bundle

## 许可证

此 bundle 基于 MIT 许可证发布。详细信息请查看 [LICENSE](LICENSE) 文件。