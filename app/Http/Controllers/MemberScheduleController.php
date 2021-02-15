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

        $ftMembers = Member::where('employment_status', 'full time')->where('location', "HQ")->get();
        $cfsMembers = Member::where('employment_status', 'CFS')->where('location', "HQ")->get();
        $parttimeMembers = Member::where('employment_status', 'part time')->where('location', "HQ")->get();

        $fulltimeMembers = $ftMembers->merge($cfsMembers);
        $members = array_merge($fulltimeMembers->toArray(), $parttimeMembers->toArray());

        $prevMemberSchedules = MemberSchedule::whereMonth('date', $previousMonth)->where('location', "HQ")->orderBy('date', 'ASC')->get();
        $currMemberSchedules = MemberSchedule::whereMonth('date', $currentMonth)->where('location', "HQ")->orderBy('date', 'ASC')->get();
        $nextMemberSchedules = MemberSchedule::whereMonth('date', $nextMonth)->where('location', "HQ")->orderBy('date', 'ASC')->get();

        $todaySchedule =  MemberSchedule::whereDate('date', Carbon::today())->where('location', "HQ")->first();

        return view('member_schedule.index', compact('todaySchedule', 'currentMonth', 'fulltimeMembers', 'parttimeMembers', 'prevMemberSchedules', 'currMemberSchedules', 'nextMemberSchedules', 'members'));
    }

    public function indexJb()
    {
        $previousMonth = Carbon::now()->subMonths(1)->month;
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonths(1)->month;

        $ftMembers = Member::where('location', "JB")->where('employment_status', 'full time')->get();
        $cfsMembers = Member::where('location', "JB")->where('employment_status', 'CFS')->get();
        $parttimeMembers = Member::where('location', "JB")->where('employment_status', 'part time')->get();

        $fulltimeMembers = $ftMembers->merge($cfsMembers);
        $members = array_merge($fulltimeMembers->toArray(), $parttimeMembers->toArray());

        $prevMemberSchedules = MemberSchedule::whereMonth('date', $previousMonth)->where('location', "JB")->orderBy('date', 'ASC')->get();
        $currMemberSchedules = MemberSchedule::whereMonth('date', $currentMonth)->where('location', "JB")->orderBy('date', 'ASC')->get();
        $nextMemberSchedules = MemberSchedule::whereMonth('date', $nextMonth)->where('location', "JB")->orderBy('date', 'ASC')->get();

        $todaySchedule =  MemberSchedule::whereDate('date', Carbon::today())->where('location', "JB")->first();

        return view('member_schedule.jb_index', compact('todaySchedule', 'currentMonth', 'fulltimeMembers', 'parttimeMembers', 'prevMemberSchedules', 'currMemberSchedules', 'nextMemberSchedules', 'members'));
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
        $location = $request->location;

        $ftMembers = Member::where('employment_status', 'full time')->where('location', $location)->get();
        $cfsMembers = Member::where('employment_status', 'CFS')->where('location', $location)->get();
        $parttimeMembers = Member::where('employment_status', 'part time')->where('location', $location)->get();

        $fulltimeMembers = $ftMembers->merge($cfsMembers);

        $allMembers = array_merge($this->getMemberArray($fulltimeMembers, false, $location), $this->getMemberArray($parttimeMembers, false, $location));

        foreach ($allMembers as $allMember) {
            $all_member_availability[] = $allMember['availability'];
        }

        $members = array_merge($this->getMemberArray($fulltimeMembers, true, $location), $this->getMemberArray($parttimeMembers, true, $location));

        foreach ($members as $member) {
            $fri_member_availability[] = $member['availability'];
        }

        foreach ($this->dateMonth($request->month) as $date) {
            if (date('D', strtotime($date)) == 'Fri') {
                $fridays[] = $date;
            }
        }

        foreach ($this->dateMonth($request->month) as $date) {
            $memberSchedule = MemberSchedule::where('date', $date)->where('location', $location)->get();
            if ($memberSchedule->isEmpty()) {

                foreach ($fridays as $friday) {
                    $memberSchedule = new MemberSchedule();
                    $memberSchedule->create([
                        'date' => $friday,
                        'members' => $members,
                        'location' => $location,
                        'total_manpower' => array_sum($fri_member_availability),
                    ]);
                }

                $filtered_dates = $this->filterDate($this->dateMonth($request->month));
                foreach ($filtered_dates as $date) {
                    $memberSchedule = new MemberSchedule();
                    $memberSchedule->create([
                        'date' => $date,
                        'members' => $allMembers,
                        'location' => $location,
                        'total_manpower' => array_sum($all_member_availability),
                    ]);
                }
            } else {
                return redirect()->back();
            }
        }

        return redirect()->route('member_schedule.index')->with('success', 'Member Schedules created successfully.');
    }

    public function update(Request $request, Member $member)
    {
        $this->validateMemberSchedule();
        $availabilities = array_combine($request->date, $request->availability);

        foreach ($availabilities as $key => $availability) {
            $memberSchedule = MemberSchedule::where('location', $member->location)->where('date', $key)->first();
            $newMembers = [];

            foreach ($memberSchedule->members as $members) {
                if ($members['member_id'] == $member->id) {
                    $members['availability'] = $availability;
                }
                array_push($newMembers, $members);
            }
            $memberSchedule->update(['members' => $newMembers]);
            $memberSchedule->update(['total_manpower' => $memberSchedule->getTotalAvailabilities($memberSchedule)]);
        }
        if ($member->location == "HQ") {
            return redirect()->route('member_schedule.index')->with('success', 'Member Schedules updated successfully.');
        } else {
            return redirect()->route('member_schedule.jb_index')->with('success', 'Member Schedules updated successfully.');
        }
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

    public function getMemberArray($members, $friday, $location)
    {
        foreach ($members as $key => $member) {
            if ($friday == false && $member->location == $location) {
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
        return $newMembers ?? [];
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
