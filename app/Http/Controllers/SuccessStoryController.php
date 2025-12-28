<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use App\Models\Member;

class SuccessStoryController extends Controller
{
    # read list of success stories
    public function index(){
        $stories = SuccessStory::with('member')->paginate(10);
        $members = Member::all();

        return view('success_stories.index', compact('stories', 'members'));
    }
    
    # create success story form
    public function create(){
        $members = Member::all();
        return view('success_stories.create', compact('members'));
    }

    # create - save new success story
    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_id' => 'required|exists:members,id',
        ]);

        SuccessStory::create([
            'title' => $request->title,
            'story' => $request->story,
            'member_id' => $request->member_id,
        ]);

        return redirect()->route('success-stories.index')
                         ->with('success', 'Success Story created successfully.');
    }

    # update success story form
    public function edit(SuccessStory $successStory)
    {
        $members = Member::all();
        return view('success_stories.edit', compact('successStory', 'members'));
    }

    # update - save edited success story
    public function update(Request $request, SuccessStory $successStory)
    {
        $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_id' => 'required|exists:members,id',
        ]);

        $successStory->update([
            'title' => $request->title,
            'story' => $request->story,
            'member_id' => $request->member_id,
        ]);

        return redirect()->route('success-stories.index')
            ->with('success', 'Success story updated.');
    }

    # delete success story
    public function destroy(SuccessStory $successStory)
    {
        $successStory->delete();
        return redirect()->route('success-stories.index');
    }


}
