<?php

namespace App\service\v1;

use Illuminate\Http\Request;

class JobQuery
{
    protected array $safeParam = [
        'title' => ['eq', 'like'],
        'salary' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'employer_id' => ['eq', 'gt', 'lt', 'gte', 'lte'],

    ];
    protected array $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'like' => 'like',
        'lte' => '<=',
        'gte' => '>='
    ];

    public function transform(Request $request): array
    {
        $eloQuery = [];

        foreach ($this->safeParam as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }
            $column = $parm;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
