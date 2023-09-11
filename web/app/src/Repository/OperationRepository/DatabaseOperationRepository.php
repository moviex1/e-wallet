<?php

namespace App\Repository\OperationRepository;

use App\Entity\Operation;
use App\Helpers\DB;
use App\Helpers\QueryBuilder;
use App\Mapper\OperationMapper\OperationFromObjectMapper;

class DatabaseOperationRepository implements OperationRepository
{
    private QueryBuilder $queryBuilder;
    private const TABLE = 'operations';

    public function __construct(readonly private OperationFromObjectMapper $operationMapper)
    {
        $this->queryBuilder = DB::createQueryBuilder();
    }

    public function findAll(): array
    {
        $operations = $this->queryBuilder
            ->addSelect(self::TABLE, '*')
            ->getQuery();

        $result = [];
        foreach ($operations as $operation) {
            $result[] = $this->operationMapper
                ->setStdOperation($operation)
                ->map();
        }

        return $result;
    }

    public function addOperation(Operation $operation): void
    {
        $this->queryBuilder->addInsert(self::TABLE, [
            'operation' => ':operation',
            'amount' => ':amount',
            'balance' => ':balance',
            'date' => ':date',
            'receiver' => ':receiver',
            'sender' => ':sender'
        ])
            ->setParameters([
                ':operation' => $operation->getOperationType()->value,
                ':amount' => $operation->getAmount(),
                ':balance' => $operation->getBalance(),
                ':date' => date('Y-m-d H:i:s'),
                ':receiver' => $operation->getReceiver(),
                ':sender' => $operation->getSender()
            ])
            ->getQuery();
    }
}