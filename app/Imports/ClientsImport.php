<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToCollection, WithHeadingRow
{
    protected int $formId;
    protected int $added = 0;
    protected int $skipped = 0;

    public function __construct(int $formId)
    {
        $this->formId = $formId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (Client::where('email', $row['email'])->exists()) {
                $this->skipped++;
                continue;
            }

            Client::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'phone'    => $row['phone'],
                'job'      => $row['job'],
                'form_id'  => $this->formId,
                'active'   => 1,
                'type'=>1,
                'country_code'=>$row['country_code'],
                'code'     => uniqid('CL-'),
            ]);

            $this->added++;
        }
    }

    public function getAddedCount(): int
    {
        return $this->added;
    }

    public function getSkippedCount(): int
    {
        return $this->skipped;
    }
}
