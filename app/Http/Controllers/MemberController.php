<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // read list of members
    public function index(Request $request){
    $query = Member::query();

    // căutare după nume sau email
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    // filtrare după profession
    if ($request->profession) {
        $query->where('profession', $request->profession);
    }

    // filtrare după company
    if ($request->company) {
        $query->where('company', $request->company);
    }

    // filtrare după status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // sortare + paginare
    $members = $query->orderBy('name')->paginate(10);

    return view('members.index', compact('members'));
 }


    // create member form
    public function create(){
        return view('members.create');
    }

    // create - save new member
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'profession' => 'required',
            'linkedin_url' => 'nullable|url|',
            'status' => 'required|in:active,inactive'
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'company' => $request->company,
            'linkedin_url' => $request->linkedin_url,
            'status' => 'active'
        ]);

        return redirect()->route('members.index')
                        ->with('success', 'Member created successfully.');
    }

    // update member form
    public function edit(Member $member){
        return view('members.edit', compact('member'));
    }

    // update - save edited member
    public function update(Request $request, Member $member){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'profession' => 'required',
            'linkedin_url' => 'nullable|url|',
            'status' => 'required|in:active,inactive'
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
                        ->with('success', 'Member updated successfully.');
    }

    // delete member
    public function destroy(Member $member){
        $member->delete();
        return redirect()->route('members.index')
                        ->with('success', 'Member deleted successfully.');  
    }

    // export members to CSV
    public function exportCsv(Request $request){
        $query = Member::query();

        // aplicăm ACELEAȘI filtre ca în index
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->profession) {
            $query->where('profession', $request->profession);
        }

        if ($request->company) {
            $query->where('company', $request->company);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $members = $query->orderBy('name')->get();

        $filename = 'members_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($members) {
            $file = fopen('php://output', 'w');

            // header CSV
            fputcsv($file, [
                'Name',
                'Email',
                'Profession',
                'Company',
                'LinkedIn',
                'Status'
            ]);

            foreach ($members as $member) {
                fputcsv($file, [
                    $member->name,
                    $member->email,
                    $member->profession,
                    $member->company,
                    $member->linkedin_url,
                    $member->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function stories(Member $member){
        $stories = $member->successStories;

        return view('members.stories', compact('member', 'stories'));
    }

}
