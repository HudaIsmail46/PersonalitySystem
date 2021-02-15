<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberSchedule;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $phone_no = $request->phone_no;

        $fullTimeMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'full time')
            ->where('location', 'HQ')
            ->orderBy('id', 'ASC')->paginate(10);

        $partTimeMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'part time')
            ->where('location', 'HQ')
            ->orderBy('id', 'ASC')->paginate(10);

        $cfsMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'CFS')
            ->where('location', 'HQ')
            ->orderBy('id', 'ASC')->paginate(10);

        return view('member.index', compact('fullTimeMembers', 'partTimeMembers', 'cfsMembers'));
    }

    public function indexJb(Request $request)
    {
        $name = $request->name;
        $phone_no = $request->phone_no;

        $fullTimeMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'full time')
            ->where('location', 'JB')
            ->orderBy('id', 'ASC')->paginate(10);

        $partTimeMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'part time')
            ->where('location', 'JB')
            ->orderBy('id', 'ASC')->paginate(10);

        $cfsMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'CFS')
            ->where('location', 'JB')
            ->orderBy('id', 'ASC')->paginate(10);

        return view('member.index', compact('fullTimeMembers', 'partTimeMembers', 'cfsMembers'));
    }

    public function show($id)
    {
        $member = Member::find($id);
        return view('member.show', compact('member'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $this->validateMembers();
        $location = $request->location;
        $member = new Member;
        $member->fill([
            'name' => $request->name,
            'phone_no' => formatPhoneNo($request->phone_no),
            'employment_status' => $request->employment_status,
            'location' => $location
        ]);
        $member->save();

        $memberSchedule = MemberSchedule::where('location', $location)->get();
        $memberSchedule->isEmpty() ? '' : $this->updateMemberSchedule($member, $location);

        return redirect()->route('member.show', $member->id)->with('success', 'Members created successfully.');
    }

    public function edit(Member $member)
    {
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $this->validateMembers();

        $member->fill([
            'name' => $request->name,
            'phone_no' => formatPhoneNo($request->phone_no),
            'employment_status' => $request->employment_status,
        ]);

        $member->save();
        return redirect()->route('member.show', $member->id)->with('success', 'Members updated successfully.');
    }

    public function destroy(Member $member)
    {
        $memberSchedules = MemberSchedule::where('location', $member->location)->whereJsonContains('members', [["member_id" => $member->id]])->get();

        foreach ($memberSchedules as $memberSchedule) {

            foreach ($memberSchedule->members as $members) {
                if ($members['member_id'] == $member->id) {
                    $deleted_member[] = $members;
                }
            }
            $updated_members = array_diff(array_map('json_encode', array_values($memberSchedule->members)), array_map('json_encode', array_values($deleted_member)));
            $new_array = array_map('json_decode', $updated_members);

            $memberSchedule->update(['members' => $new_array]);
            $memberSchedule->update(['total_manpower' => $memberSchedule->getTotalAvailabilities($memberSchedule)]);
        }

        $member->delete();

        return redirect()->route('member.index')->with('Member succesfully deleted.');
    }

    public function updateMemberSchedule($member, $location)
    {
        $memberArray = $this->getMemberArray($member, false, $location);
        $friMemberArray = $this->getMemberArray($member, true, $location);

        $memberSchedules = MemberSchedule::where('location', $location)->whereMonth('date', '>=', $member->created_at->format('m'))->get();

        foreach ($memberSchedules as $memberSchedule) {
            if (date('D', strtotime($memberSchedule->date)) == 'Fri') {
                $fridays[] = date($memberSchedule->date);

                $fridayMember = array_merge($friMemberArray, $memberSchedule->members);
                $memberSchedule->update(['members' => $fridayMember]);
            } else {
                $allDate[] = date($memberSchedule->date);
                $newMember = array_merge($memberArray, $memberSchedule->members);
                $memberSchedule->update(['members' => $newMember]);
            }
            $memberSchedule->update(['total_manpower' => $memberSchedule->getTotalAvailabilities($memberSchedule)]);
        }
    }

    public function getMemberArray($member, $friday, $location)
    {
        if ($friday == false && $member->location == $location) {
            if ($member->employment_status == "full time" || $member->employment_status == "CFS") {
                $availability = "1";
            } else {
                $availability = "0";
            }
        } else {
            $availability = "0";
        }

        $newMember[] = (['member_id' => $member->id, 'member_name' => $member->name, 'remarks' => '', 'availability' => $availability]);
        return $newMember;
    }

    protected function validateMembers()
    {
        return request()->validate([
            'name' => 'required',
            'location' => 'required',
            'phone_no' => 'required',
            'employment_status' => 'required',
        ]);
    }
}
