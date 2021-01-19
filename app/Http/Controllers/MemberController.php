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
            ->orderBy('id', 'ASC')->paginate(10);

        $partTimeMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'part time')
            ->orderBy('id', 'ASC')->paginate(10);

        $cfsMembers = Member::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->where('employment_status', 'CFS')
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
        $member = new Member;
        $member->fill([
            'name' => $request->name,
            'phone_no' => formatPhoneNo($request->phone_no),
            'employment_status' => $request->employment_status,
        ]);
        $member->save();

        $this->updateMemberSchedule($member);

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
        $member->delete();
        return redirect()->route('member.index')->with('Member succesfully deleted.');
    }

    public function updateMemberSchedule($member)
    {

        if ($member->employment_status == "full time" || $member->employment_status == "CFS") {
            $member_availability = "1";
        } else {
            $member_availability = "0";
        }

        $memberSchedules = MemberSchedule::whereMonth('date','>=', $member->created_at->format('m'))->get();
        $newMember = [['member_id' => $member->id, 'member_name' => $member->name, 'remarks' => '', 'availability' =>  $member_availability]];

        foreach ($memberSchedules as $memberSchedule) {

            $newMembers = array_merge($newMember, $memberSchedule->members);
            $memberSchedule->update(['members' => $newMembers]);
        }

        foreach ($memberSchedule->members as $member) {
            $member_availabilities[] = $member['availability'];
        }

        $memberSchedule->fill([
            'total_manpower' => array_sum($member_availabilities),
        ]);
        $memberSchedule->save();
    }

    protected function validateMembers()
    {
        return request()->validate([
            'name' => 'required',
            'phone_no' => 'required',
            'employment_status' => 'required',
        ]);
    }
}
