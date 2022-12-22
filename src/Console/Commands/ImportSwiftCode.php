<?php

namespace Wovosoft\BankSwiftcodes\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Wovosoft\BankSwiftcodes\Models\SwiftCode;

class ImportSwiftCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank-swiftcodes:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Bank Swift Codes';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Throwable
     */
    public function handle(): int
    {
        $path = __DIR__ . "/../../../assets/SwiftCodes-master/SwiftCodes-master/AllCountries";
        $this->info("\nInserting Swift Codes\n");
        $files = collect(File::allFiles($path));
        $this->output->progressStart($files->count());
        $files->each(function (\SplFileInfo $fileInfo) {
            $this->info($fileInfo->getBasename());

            $items = json_decode(File::get($fileInfo->getRealPath()));
            foreach ($items->list as $swift) {
                $model = new SwiftCode();
                $model->forceFill([
                    "country" => $items->country,
                    "country_code" => $items->country_code,
                    "bank" => $swift->bank,
                    "city" => $swift->city,
                    "branch" => $swift->branch,
                    "swift_code" => $swift->swift_code,
                ]);
                $model->saveOrFail();
            }

            $this->output->progressAdvance();
        });
        $this->output->progressFinish();

        return CommandAlias::SUCCESS;
    }
}
