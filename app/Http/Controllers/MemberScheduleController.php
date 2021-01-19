<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberSchedule;
use Carbon\Carbon;

class MemberScheduleController extends Controller
{
    public function index()
    {
        $previousMonth = Carbon::now()->subMonths(1)->month;
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonths(1)->month;

        $fulltimeMembers = Member::where('employment_status', 'full time')->orWhere('employment_status', 'CFS')->get();
        $parttimeMembers = Member::where('employment_status', 'part time')->get();

        $members = array_merge($fulltimeMembers->toArray(), $parttimeMembers->toArray());

        $prevMemberSchedules = MemberSchedule::whereMonth('date', $previousMonth)->orderBy('date', 'ASC')->get();
        $currMemberSchedules = MemberSchedule::whereMonth('date', $currentMonth)->orderBy('date', 'ASC')->get();
        $nextMemberSchedules = MemberSchedule::whereMonth('date', $nextMonth)->orderBy('date', 'ASC')->get();

        $todaySchedule =  MemberSchedule::whereDate('date', Carbon::today())->first();

        return view('member_schedule.index', compact('todaySchedule', 'currentMonth', 'fulltimeMembers', 'parttimeMembers', 'prevMemberSchedules', 'currMemberSchedules', 'nextMemberSchedules', 'members'));
    }

    public function edit(Member $member, $date)
    {
        $memberSchedules = MemberSchedule::whereMonth('date', $date)->whereJsonContains('members', [["member_id" => $member->id]])->orderBy('date', 'ASC')->get();

        foreach ($memberSchedules as $memberSchedule) {
            $month_name = $memberSchedule->date;
            foreach ($memberSchedule->members as $members) {
                if ($members['member_id'] == $member->id)

                    $totalAvailabilities[] = $members['availability'];
            }
        }
        $totalWorkingDays = array_sum($totalAvailabilities);


        return view('member_schedule.edit', compact('member', 'memberSchedules', 'month_name', 'totalWorkingDays'));
    }

    public function create()
    {
        return view('member_schedule.index');
    }

    public function store(Request $request)
    {
        $fulltimeMembers = Member::where('employment_status', 'full time')->orWhere('employment_status', 'CFS')->get();
        $parttimeMembers = Member::where('employment_status', 'part time')->get();

        $allMembers = array_merge($this->getMemberArray($fulltimeMembers, false), $this->getMemberArray($parttimeMembers, false));

        foreach ($allMembers as $allMember) {
            $all_member_availability[] = $allMember['availability'];
        }

        $members = array_merge($this->getMemberArray($fulltimeMembers, true), $this->getMemberArray($parttimeMembers, true));

        foreach ($members as $member) {
            $fri_member_availability[] = $member['availability'];
        }

        foreach ($this->dateMonth($request->month) as $date) {
            if (date('D', strtotime($date)) == 'Fri') {
                $fridays[] = $date;
            }
        }

        foreach ($this->dateMonth($request->month) as $date) {
            $memberSchedule = MemberSchedule::where('date', $date)->get();
            if ($memberSchedule->isEmpty()) {

                foreach ($fridays as $friday) {
                    $memberSchedule = new MemberSchedule();
                    $memberSchedule->create([
                        'date' => $friday,
                        'members' => $members,
                        'total_manpower' => array_sum($fri_member_availability),
                    ]);
                }

                $filtered_dates = $this->filterDate($this->dateMonth($request->month));
                foreach ($filtered_dates as $date) {
                    $memberSchedule = new MemberSchedule();
                    $memberSchedule->create([
                        'date' => $date,
                        'members' => $allMembers,
                        'total_manpower' => array_sum($all_member_availability),
                    ]);
                }
                
            } else {
                return redirect()->back()->with('warning', 'This month schedule already existed.');
            }
        }

        return redirect()->route('member_schedule.index')->with('success', 'Member Schedules created successfully.');
    }

    public function update(Request $request, Member $member)
    {
        $this->validateMemberSchedule();
        $availabilities = array_combine($request->date, $request->availability);

        foreach ($availabilities as $key => $availability) {
            $memberSchedule = MemberSchedule::where('date', $key)->first();
            $newMembers = [];

            foreach ($memberSchedule->members as $members) {
                if ($members['member_id'] == $member->id) {
                    $members['availability'] = $availability;
                }
                array_push($newMembers, $members);
            }
            $memberSchedule->update(['members' => $newMembers]);
            $memberSchedule->update(['total_manpower' => $this->getTotalAvailabilities($memberSchedule)]);
        }

        return redirect()->route('member_schedule.index')->with('success', 'Member Schedules updated successfully.');
    }

    public function dateMonth($month)
    {
        $num = cal_days_in_month(CAL_GREGORIAN,  $month, Carbon::now()->year);
        $dates_month = array();

        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0,  $month, $i, Carbon::now()->year);
            $date = date("d-M-Y", $mktime);
            $dates_month[$i] = $date;
        }

        return $dates_month;
    }

    public function getTotalAvailabilities(MemberSchedule $memberSchedule)
    {
        foreach ($memberSchedule->members as $member) {
            $member_availabilities[] = $member['availability'];
        }
        $total_member_availabilities = array_sum($member_availabilities);
        return $total_member_availabilities;
    }

    public function getMemberArray($members, $friday)
    {
        foreach ($members as $key => $member) {

            if ($friday == false) {
                if ($member->employment_status == "full time" || $member->employment_status == "CFS") {
                    $availability = "1";
                } else {
                    $availability = "0";
                }
            } else {
                $availability = "0";
            }

            $id[] = $member->id;
            $name[] = $member->name;
            $newMembers[] = (['member_id' => $id[$key], 'member_name' => $name[$key], 'remarks' => '', 'availability' => $availability]);
        }
        return $newMembers;
    }

    public function filterDate($dates)
    {
        foreach ($dates as $date) {

            if (date('D', strtotime($date)) == 'Fri') {
                $friday[] = $date;
            }
        }
        return array_diff($dates, $friday);
    }

    protected function validateMemberSchedule()
    {
        return request()->validate([
            'availability.*' => 'required',
        ]);
    }
}
