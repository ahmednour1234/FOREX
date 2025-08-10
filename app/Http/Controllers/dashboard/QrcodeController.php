<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Qrcode as QrcodeModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\ClientQrMail;

class QrcodeController extends Controller
{
    public function index(Request $request)
    {
        $qrcodes = QrcodeModel::query();

        if ($request->filled('register_id')) {
            $qrcodes->where('register_id', $request->register_id);
        }


        if ($request->filled('short_code')) {
            $qrcodes->where('short_code', $request->short_code);
        }

        if ($request->filled('from_date')) {
            $qrcodes->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $qrcodes->whereDate('created_at', '<=', $request->to_date);
        }

        $qrcodes = $qrcodes->latest()->paginate(20);

        return view('content.qrcodes.index', compact('qrcodes'));
    }

    public function toggleStatus($id)
    {
        $qrcode = QrcodeModel::findOrFail($id);
        $qrcode->active = !$qrcode->active;
        $qrcode->save();

        return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
    }

    public function regenerateAndResend($id)
    {
        $qrcode = QrcodeModel::findOrFail($id);
        $client = Client::findOrFail($qrcode->register_id);

        $shortCode = Str::random(10);
        $qrUrl = url('/qr/' . $shortCode);

        $directory = public_path('qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = 'qr_' . time() . '_' . $client->id . '.png';
        $filePath = $directory . '/' . $fileName;
        QrCode::format('png')->size(300)->generate($qrUrl, $filePath);
        $qrImageUrl = asset('qrcodes/' . $fileName);

        $qrcode->update([
            'qrcode' => $fileName,
            'short_code' => $shortCode
        ]);

        Mail::to($client->email)->send(new ClientQrMail($client, $qrUrl, $qrImageUrl));

        return redirect()->back()->with('success', 'تم توليد كود جديد وإرسال البريد');
    }
       public function scanner()
    {
        return view('content.qrcodes.scan');
    }
public function check(Request $request)
    {
        $code = $request->input('code');

        // ✅ استخراج الكود فقط من الرابط إذا أُرسل رابط كامل
        if (Str::startsWith($code, 'http')) {
            $parts = explode('/', rtrim($code, '/'));
            $code = end($parts);
        }

        $qr = QrcodeModel::where('short_code', $code)->first();

        if (! $qr) {
            return response()->json([
                'status' => 'error',
                'message' => 'رمز QR غير صالح.',
            ]);
        }

        if ($qr->scan > 0) {
            return response()->json([
                'status' => 'scanned',
                'message' => 'تم استخدام الرمز مسبقًا.',
            ]);
        }

        $qr->scan += 1;
        $qr->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم تسجيل الحضور بنجاح.',
            'short_code' => $code,
        ]);
    }
}
