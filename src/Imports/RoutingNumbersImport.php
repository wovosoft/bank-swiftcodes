<?php

namespace Wovosoft\BankSwiftcodes\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Wovosoft\BankSwiftcodes\Models\Bank;
use Wovosoft\BankSwiftcodes\Models\RoutingNumber;
use Wovosoft\BdGeocode\Models\District;

class RoutingNumbersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|RoutingNumber|null
     */
    public function model(array $row): Model|RoutingNumber|null
    {
        return (new RoutingNumber())->forceFill([
            "bank_code" => $row['bankcode'],
            "bank_id" => $this->findBank($row['bannkname']),
            "bank_name" => $row['bannkname'],
            "branch_name" => $row['branchname'],
            "branch_code" => $row['branchcode'],
            "routing_no" => $row['routingno'],
            "district_id" => $this->findDistrict($row['district']),
            "district_code" => $row['distcode'],
            "district" => $row['district'],
        ]);
    }

    private function findDistrict(string $district)
    {
        return District::query()
            ->where(DB::raw("lower(name)"), "like", strtolower($district))
            ->first()
            ?->id;
    }

    private function findBank(string $bankName)
    {
        return Bank::query()
            ->where(
                DB::raw("lower(name)"),
                "=",
                strtolower($bankName)
            )
            ->first()?->id;
    }
}
