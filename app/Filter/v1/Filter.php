<?php

namespace App\Filter\v1;

use Illuminate\Http\Request;


class Filter {

    protected $safeParms = [];
    
    protected $columnMap = [];

    protected  $operatorMap = [];

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->safeParms as $parm => $operators){
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    if ($this->operatorMap[$operator] == 'like') {
                        $eloQuery[] = [$column, $this->operatorMap[$operator], '%' . $query[$operator] . '%'];
                    } else {
                        $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                    }
                    
                }
            }
        }

        return $eloQuery;
    }
}