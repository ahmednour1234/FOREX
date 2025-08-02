<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LuxuryCommunityMember;
use App\Helpers\FileHelper;

class LuxuryCommunityMemberController extends Controller
{
    public function index()
    {
        $members = LuxuryCommunityMember::latest()->get();
        return view('content.luxury_community_members.index', compact('members'));
    }

    public function create()
    {
        return view('content.luxury_community_members.create');
    }
public function store(Request $request)
{
    $data = $request->validate([
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'title_ar' => 'required|string|max:255',
        'title_en' => 'nullable|string|max:255',
        'company' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:50',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = FileHelper::uploadImage($request->file('image'), 'luxury_members');
    }

    LuxuryCommunityMember::create($data);

    return redirect()->route('dashboard.luxury-members.index')->with('success', 'تمت الإضافة بنجاح');
}


    public function edit($id)
    {
        $member = LuxuryCommunityMember::findOrFail($id);
        return view('content.luxury_community_members.edit', compact('member'));
    }
public function update(Request $request, $id)
{
    $member = LuxuryCommunityMember::findOrFail($id);

    $data = $request->validate([
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'title_ar' => 'required|string|max:255',
        'title_en' => 'nullable|string|max:255',
        'company' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:50',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = FileHelper::uploadImage($request->file('image'), 'luxury_members', $member->image);
    }

    $member->update($data);

    return redirect()->route('dashboard.luxury-members.index')->with('success', 'تم التحديث بنجاح');
}


    public function destroy($id)
    {
        $member = LuxuryCommunityMember::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
