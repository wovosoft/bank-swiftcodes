<?php

namespace Wovosoft\BankSwiftcodes\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Wovosoft\BankSwiftcodes\Imports\RoutingNumbersImport;

class ImportRoutingNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:routing_numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Excel::import(new RoutingNumbersImport, __DIR__ . "/../../../assets/RoutingNoList.xlsx");
        $this->info("Routing Numbers Imported Successfully");
        return CommandAlias::SUCCESS;
    }
}
