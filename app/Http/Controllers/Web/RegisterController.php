<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Qrcode as QrcodeModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientQrMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('web.content.register');
    }

    public function becomesponsor()
    {
        return view('web.content.becomesponsor');
    }

public function store(Request $request)
{
    $data = $request->validate([
'name'          => 'required|string|max:255',
'email'         => 'required|email',
'phone'         => 'required|string',
'job'           => 'required|string|max:255',
'country_code'  => 'required|string',
'company_name'  => 'nullable|string',
'img'           => 'nullable|image',
'type'          => 'required|in:1,2',

    ]);

    // جلب أحدث نموذج form
    $latestForm = \App\Models\Form::latest('id')->first();
    if (! $latestForm) {
        return redirect()->back()->withErrors(['form_id' => 'لا يوجد نموذج form حالياً.'])->withInput();
    }

    $data['form_id'] = $latestForm->id;

    // إنشاء العميل
    $client = Client::create($data);

    if ($data['type'] == 2) {
        // إرسال SMS
        try {
            $url = "https://app.community-ads.com/SendSMSAPI/api/SMSSender/SendSMS";
            $uuid = \Illuminate\Support\Str::uuid()->toString();

            $smsText  = "New Forex traders summit Sponsor\n";
            $smsText .= "Name: {$data['name']}\n";
            $smsText .= "Email: {$data['email']}\n";
            $smsText .= "Phone: {$data['phone']}\n";
            $smsText .= "Source: https://forextraderssummit.iqbrandx.com/public/\n";
            $smsText .= "Position: {$data['job']}\n";
            $smsText .= "Company: {$data['company_name']}";

            $postData = [
                "UserName"     => "Smartvision2",
                "Password"     => "=-bZ%Jp_UI",
                "SMSText"      => $smsText,
                "SMSLang"      => "e",
                "SMSSender"    => "SmartVision",
                "SMSReceiver"  => "01224984005",
                "SMSID"        => $uuid,
            ];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => [
                    "Content-Type: application/json"
                ],
                CURLOPT_POSTFIELDS     => json_encode($postData),
            ]);

            $response = curl_exec($ch);
            $error    = curl_error($ch);
            curl_close($ch);

            if ($error) {
                \Log::error("❌ cURL Error while sending SMS: $error");
            } else {
                \Log::info("✅ SMS sent successfully. Response: $response");
            }
        } catch (\Exception $e) {
            \Log::error("❌ Exception while sending SMS: " . $e->getMessage());
        }

    } elseif($data['type'] == 1) {
       try {
    $shortCode = Str::random(10);
    $qrUrl = url('/qr/' . $shortCode);

    // تأكد من وجود مجلد public/qrcodes
    $directory = public_path('qrcodes');
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    // اسم الملف الكامل
    $fileName = 'qr_' . time() . '_' . $client->id . '.png';
    $filePath = $directory . '/' . $fileName;
$fileName = 'qr_' . time() . '_' . $client->id . '.png';
$qrImageUrl = asset('qrcodes/' . $fileName);  // مثال: https://forextraderssummit.iqbrandx.com/qrcodes/qr_1728392139_5.png

    // توليد QR code وحفظه كصورة
    \QrCode::format('png')->size(300)->generate($qrUrl, $filePath);

    // إرسال الإيميل
    Mail::to($client->email)->send(new ClientQrMail(
        $client,
        $qrUrl,
       $qrImageUrl
    ));
$shortCode = Str::random(10); // مثل: PlIWLB92bO

    // حفظ السجل في قاعدة البيانات
    QrcodeModel::create([
        'qrcode'      => $fileName,
        'active'      => 1,
            'short_code'  => $shortCode, // أضف هذا العمود للمستقبل
    'email'        => $client->email,
        'scan'        => 0,
        'register_id' => $client->id,
    ]);
} catch (\Exception $e) {
    \Log::error("❌ Error while sending email or saving QR: " . $e->getMessage());
}

    }

    return redirect()->back()->with('success', 'تم تسجيلك بنجاح، سنقوم بالتواصل معك قريبًا');
}



}
