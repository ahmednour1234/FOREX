<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LuxuryCommunityMember;
use App\Models\HomeSection;
use App\Helpers\FileHelper;

class LuxuryCommunityMemberController extends Controller
{
    public function index()
    {
        $members = LuxuryCommunityMember::latest()->get();
            $aboutSection   = HomeSection::where('is_active', true)->where('id', 3)->first();

        return view('web.content.luxury', compact('members','aboutSection'));
    }

}
