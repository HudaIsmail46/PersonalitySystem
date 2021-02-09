<?php

namespace App\Exports;

use App\TeamMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeamMemberExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{

    public function headings(): array
    {
        return [
            '#',
            'Team',
            'Member 1',
            'Member 2',
            'Member 3',
            'Date',
        ];
    }

    public function collection()
    {
        return TeamMember::with('member1', 'member2', 'member3', 'team')->get();
    }

    public function map($teamMember): array
    {
        switch ($teamMember->team->name) {
            case "BIRU":
                $teamMember->team->name = "HQ1";
                break;
            case "KUNING":
                $teamMember->team->name = "HQ2";
                break;
            case "MERAH":
                $teamMember->team->name = "HQ3";
                break;
            case "HIJAU":
                $teamMember->team->name = "HQ4";
                break;
            case "UNGU":
                $teamMember->team->name = "HQ5";
                break;
            case "KELABU":
                $teamMember->team->name = "HQ6";
                break;
            case "COKLAT":
                $teamMember->team->name = "HQ7";
                break;
            case "PUMPKIN":
                $teamMember->team->name = "AUX1";
                break;
            case "AVOCADO":
                $teamMember->team->name = "AUX2";
                break;
            case "WISTERIA":
                $teamMember->team->name = "AUX3";
                break;
            case "BIRCH":
                $teamMember->team->name = "AUX4";
                break;
            case "FLAMINGO":
                $teamMember->team->name = "AUX5";
                break;
            case "JB1":
                $teamMember->team->name = "JB SATU";
                break;
            default:
                $teamMember->team->name;
        }

        return [
            $teamMember->id,
            $teamMember->team->name,
            $this->memberExist($teamMember->member1)  ? '' : $teamMember->member1->name. "" . $this->employeeStatus($teamMember->member1->employment_status),
            $this->memberExist($teamMember->member2)  ? '' : $teamMember->member2->name. "" . $this->employeeStatus($teamMember->member2->employment_status),
            $this->memberExist($teamMember->member3)  ? '' : $teamMember->member3->name. "" . $this->employeeStatus($teamMember->member3->employment_status),
            $teamMember->date,
        ];
    }

    public function employeeStatus($employment_status)
    {
        switch ($employment_status) {
            case "part time":
                $employment_status = " PT";
                break;
            case "CFS":
                $employment_status = " CFS";
                break;
            default:
                $employment_status = null;
        }

        return $employment_status;
    }

    public function memberExist($member)
    {
        $members = $member ?? '';

        if($members == '')
            return true;
    }
}
