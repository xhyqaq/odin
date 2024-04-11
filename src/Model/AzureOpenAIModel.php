<?php

namespace Hyperf\Odin\Model;


use Hyperf\Odin\Api\AzureOpenAI\AzureOpenAI;
use Hyperf\Odin\Api\AzureOpenAI\AzureOpenAIConfig;
use Hyperf\Odin\Api\AzureOpenAI\Client as AzureOpenAIClient;
use Hyperf\Odin\Api\OpenAI\Response\ChatCompletionResponse;

class AzureOpenAIModel implements ModelInterface
{

    public function __construct(public string $model, public array $config)
    {

    }

    public function chat(
        array $messages,
        float $temperature = 0.9,
        int $maxTokens = 0,
        array $stop = [],
        array $tools = [],
    ): ChatCompletionResponse {
        $client = $this->getAzureOpenAIClient();
        return $client->chat($messages, $this->model, $temperature, $maxTokens, $stop, $tools);
    }

    public function getAzureOpenAIClient(): AzureOpenAIClient
    {
        $openAI = new AzureOpenAI();
        $config = new AzureOpenAIConfig($this->config);
        return $openAI->getClient($config, $this->model);
    }
}