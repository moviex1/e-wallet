<?php

namespace App\Controller;

use App\Enums\OperationType;
use App\Mapper\OperationMapper\OperationFromRequestMapper;
use App\Repository\OperationRepository\OperationRepository;

class OperationController
{
    private array $requiredFields = ['operation', 'amount', 'balance', 'sender', 'receiver'];

    public function __construct(
        readonly private OperationFromRequestMapper $operationMapper,
        readonly private OperationRepository $operationRepository
    )
    {
    }

    public function addOperation(): string
    {
        var_dump($_POST);
        if (!$this->validateRequest()) {
            http_response_code(400);
            return 'Invalid request Body';
        }
        $operation = $this->operationMapper->map();
        $this->operationRepository->addOperation($operation);
        return 'OK';
    }

    private function validateRequest(): bool
    {
        foreach ($this->requiredFields as $key) {
            if (!array_key_exists($key, $_POST)) {
                echo $key;
                return false;
            }
        }

        if (OperationType::fromName($_POST['operation']) === null) {
            return false;
        }

        return true;
    }
}