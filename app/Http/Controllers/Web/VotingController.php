<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\HomeSection;
use App\Models\Speaker;
use App\Models\Prize;
use App\Models\Voting;
use App\Models\Sponsor;
use App\Models\Company;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VotingController extends Controller
{
   public function index()
{
    $aboutSection   = HomeSection::where('is_active', true)->where('id', 3)->first();
    $gallery_section = HomeSection::where('is_active', true)->where('id', 6)->first();
    $sponsor_section = HomeSection::where('is_active', true)->where('id', 7)->first();
    $sponsor_section = HomeSection::where('is_active', true)->where('id', 7)->first();
    $speaker_section = HomeSection::where('is_active', true)->where('id', 4)->first();
    $speakers        = Speaker::where('active', true)->paginate(6);
    $schedule_section = HomeSection::where('is_active', true)->where('id', 5)->first();
    $event           = Event::first();
$companies = Company::where('active', 1)
    ->orderByRaw("CASE WHEN category = 'Top 100 Member' THEN 0 ELSE 1 END")
    ->get();
    $prizes=Prize::where('active',1)->take(4)->get();
  $sponsors=Sponsor::where('active', true)
        ->orderBy('created_at', 'desc')
        ->get();

    $gallieries = Gallery::where('active', true)
        ->orderBy('created_at', 'desc')
        ->get();
 $eventDays = [];
    $schedules = collect();

    if ($event) {
        $schedules = DB::table('event_schedules')
            ->where('event_id', $event->id)
            ->orderBy('start_datetime')
            ->get();

        foreach ($schedules as $schedule) {
            $date = Carbon::parse($schedule->start_datetime)->format('Y-m-d');
            $eventDays[$date] = Carbon::parse($schedule->start_datetime)->translatedFormat('j F Y');
        }

        ksort($eventDays);
    }
    return view('web.content.voting', compact(
        'aboutSection',
        'gallieries',
        'gallery_section',
        'sponsor_section',
        'sponsors',
        'speaker_section',
        'speakers',
        'schedule_section',
        'event',
        'schedules',
        'eventDays',
        'companies',
        'prizes'
    ));
}
public function show($id)
{
        $aboutSection   = HomeSection::where('is_active', true)->where('id', 3)->first();

    $company = Company::where('active', 1)->findOrFail($id);

    return view('web.content.company_details', compact('company','aboutSection'));
}
public function vote($id)
{
    $company = Company::findOrFail($id);
    $ip = request()->ip();

    $recentVote = Voting::where('company_id', $company->id)
        ->where('ip_address', $ip)
        ->where('created_at', '>=', now()->subMinutes(30))
        ->first();

    if ($recentVote) {
        return response()->json([
            'message' => 'You have already voted for this company in the last 30 minutes.'
        ], 429); // <-- سيظهر هذا في popup الآن
    }

    Voting::create([
        'company_id' => $company->id,
        'ip_address' => $ip,
    ]);

    $company->increment('count_vote');

    return response()->json([
        'message' => 'Thanks for voting for ' . $company->name_en . '!'
    ]);
}



}
