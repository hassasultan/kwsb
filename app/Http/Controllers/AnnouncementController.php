<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Traits\SaveImage;
use Storage;


class AnnouncementController extends Controller
{
    //
    use SaveImage;
    public function index(Request $request)
    {
        $announcement = Announcement::first();
        if($request->has('api'))
        {
            $announcement = Announcement::where('status', 1)->first();
            return response()->json($announcement);
        }
        return view('pages.announcements.index', compact('announcement'));
    }

    public function create()
    {
        $announcement = Announcement::first();

        // Prevent creating more than one record
        if ($announcement) {
            return redirect()->route('announcements.index')->with('error', 'Only one announcement can be created.');
        }

        return view('pages.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0',
        ]);

        $announcement = Announcement::first();

        // Prevent creating more than one record
        if ($announcement) {
            return redirect()->route('announcements.index')->with('error', 'Only one announcement can be created.');
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $this->announcementImage($request->image);
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('pages.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $this->announcementImage($request->image);
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }
}
