<?php

namespace App\Http\Controllers;

use App\Models\BMI;
use App\Models\BMR;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // MEALUKAN VALIDATION FORM HARUS TERSISI
        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'username' => ['required', 'max:100',  Rule::unique(User::class)],
            'nik' => ['max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'jenis_kelamin' => ['string', 'max:1', 'required'],
            'usia' => ['string', 'min:1', 'max:100', 'required'],
            'tinggi_badan' => ['string', 'min:1', 'required'],
            'berat_badan' => ['string', 'min:1', 'required'],
            'password' => ['required', 'min:4', 'max:255'],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'password' =>  bcrypt($request->password),
        ]);

        // Hitung BMI
        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'] / 100;
        $bmi =  round($berat_badan / ($tinggi_badan * $tinggi_badan), 2);
        $statusBMI = "";
        $keteranganBMI = '';

        if ($bmi <= 18.5) {
            $statusBMI = "Underweight";
            $keteranganBMI = "Anda masuk dalam kategori Underweight atau berat badan kurang. BMI Underweight berarti bahwa berat badan Anda lebih rendah dari yang seharusnya berdasarkan tinggi badan Anda. Kondisi ini dapat berpotensi menimbulkan berbagai masalah kesehatan, seperti sistem kekebalan tubuh yang lemah, risiko osteoporosis, dan gangguan menstruasi pada perempuan. Untuk menjaga kesehatan dan kualitas hidup Anda, disarankan untuk memeriksakan kondisi Anda ke profesional kesehatan seperti dokter atau ahli gizi. Mereka dapat memberikan saran yang tepat untuk peningkatan berat badan Anda yang sehat dan seimbang, yang melibatkan asupan nutrisi yang cukup dan olahraga yang tepat. Selalu ingat, sehat bukan hanya soal angka di timbangan, tetapi juga tentang bagaimana Anda merasa baik dan bugar dalam melakukan aktivitas sehari-hari.";
        } elseif ($bmi >= 18.5 and $bmi <= 24.9) {
            $statusBMI = "Normal";
            $keteranganBMI = "Anda berada dalam kategori Normal. Ini berarti berat badan Anda berada dalam rentang yang sehat untuk tinggi badan Anda. Memiliki berat badan dalam kisaran normal dapat menurunkan risiko Anda terhadap berbagai masalah kesehatan, seperti penyakit jantung, tekanan darah tinggi, dan diabetes tipe 2. Meski berada dalam kategori ini, penting untuk menjaga gaya hidup sehat dan seimbang. Olahraga secara teratur, makan makanan seimbang yang kaya nutrisi, dan menjaga pola tidur yang baik adalah beberapa cara untuk mempertahankan berat badan dan kesehatan Anda. Selalu ingat bahwa sehat bukan hanya tentang berat badan, tetapi juga tentang merasa baik dan bugar dalam melakukan aktivitas sehari-hari Anda. Jika Anda memiliki pertanyaan atau kekhawatiran tentang berat badan atau kesehatan Anda, diskusikan dengan dokter atau ahli gizi.";
        } elseif ($bmi >= 25 and $bmi <= 29.9) {
            $statusBMI = "Overweight";
            $keteranganBMI = "Anda berada dalam kategori Pre-obesitas. Pre-obesitas berarti berat badan Anda sedikit lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Meskipun ini bukan obesitas, kategori ini tetap menunjukkan risiko kesehatan yang lebih tinggi jika dibandingkan dengan berat badan normal. Kondisi pre-obesitas dapat meningkatkan risiko Anda terhadap penyakit jantung, tekanan darah tinggi, diabetes tipe 2, dan masalah kesehatan lainnya. Untuk mengurangi risiko tersebut, sangat penting bagi Anda untuk mencoba menurunkan berat badan ke dalam kisaran yang sehat. Ini bisa dilakukan melalui peningkatan aktivitas fisik dan pola makan sehat yang seimbang. Mencapai dan mempertahankan berat badan yang sehat bukan hanya tentang penampilan, tetapi juga tentang memelihara kesehatan dan kualitas hidup Anda. Diskusikan dengan profesional kesehatan seperti dokter atau ahli gizi untuk mendapatkan rencana penurunan berat badan yang sehat dan berkelanjutan.";
        } else {
            $statusBMI = "Obesitas";
            $keteranganBMI = "Anda berada dalam kategori Obesitas. Obesitas berarti berat badan Anda secara signifikan lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Kondisi ini menimbulkan risiko kesehatan yang serius, termasuk penyakit jantung, diabetes tipe 2, tekanan darah tinggi, dan beberapa jenis kanker. Dalam beberapa kasus, obesitas juga dapat mempengaruhi kualitas hidup Anda dan dapat menyebabkan masalah psikologis seperti penurunan rasa percaya diri dan depresi. Sangat penting bagi Anda untuk memulai langkah-langkah penurunan berat badan yang sehat dan berkelanjutan. Hal ini dapat dicapai dengan membuat perubahan gaya hidup, seperti meningkatkan aktivitas fisik dan menjalankan pola makan seimbang. Selalu diskusikan rencana kesehatan Anda dengan dokter atau ahli gizi profesional untuk mendapatkan pendekatan terbaik dalam mencapai dan mempertahankan berat badan yang sehat. Ingatlah, perjalanan ini bukan tentang penurunan berat badan semata, tetapi tentang peningkatan kesehatan dan kualitas hidup secara keseluruhan.";
        }

        BMI::create([
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'bmi' => $bmi,
            'status' => $statusBMI,
            'keterangan' => $keteranganBMI,
            'user_id' => $user->id
        ]);

        // Hitung BMR
        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'];
        $usia = (float)$request['usia'];
        $bmr = 0;

        if ($request['jenis_kelamin'] === "L") {
            $bmr = round(66.5 + (13.7 * $berat_badan) + (5 * $tinggi_badan) - (6.8 * $usia), 2);
        }

        if ($request['jenis_kelamin'] === "P") {
            $bmr = round(655 + (9.6 * $berat_badan) + (1.8 * $tinggi_badan) - (4.7 * $usia), 2);
        }

        BMR::create([
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tinggi_badan' =>  $tinggi_badan,
            'berat_badan' => $berat_badan,
            'usia' =>  $usia,
            'bmr' => $bmr,
            'status' => 'belum dibuat',
            'user_id' => $user->id,
        ]);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
            ],
            'data' => $user,
        ], 200);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:4', 'max:255'],
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Username yang dimasukan salah.'],
                'password' => ['Password yang dimasukan salah.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => "Success"
            ],
            'data' => $user,
            'access_token' => [
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        // Revoke a specific token...
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'data' => [
                "Berhasil logout"
            ],
            'meta' => [
                'code' => 200,
                'status' => true,
                'message' => "Successfully logout"
            ],
        ], 200);
    }

    public function accountData()
    {
        $currentUserId =  Auth::user()->id;
        $userData = User::findOrFail($currentUserId);
        return response()->json([
            'data' => $userData,
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => "Success"
            ],
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $currentUserId =  Auth::user()->id;
        $userData = User::findOrFail($currentUserId);

        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'username' => ['required', 'max:100',],
            'nik' => ['max:100'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'jenis_kelamin' => ['string', 'max:1', 'required'],
            'usia' => ['string', 'min:1', 'max:100', 'required'],
            'tinggi_badan' => ['string', 'min:1', 'required'],
            'berat_badan' => ['string', 'min:1', 'required'],
        ]);

        $userData->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'password' =>  bcrypt($request->password),
        ]);

        // Hitung BMI
        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'] / 100;
        $bmi =  round($berat_badan / ($tinggi_badan * $tinggi_badan), 2);
        $statusBMI = "";
        $keteranganBMI = '';

        if ($bmi <= 18.5) {
            $statusBMI = "Underweight";
            $keteranganBMI = "Anda masuk dalam kategori Underweight atau berat badan kurang. BMI Underweight berarti bahwa berat badan Anda lebih rendah dari yang seharusnya berdasarkan tinggi badan Anda. Kondisi ini dapat berpotensi menimbulkan berbagai masalah kesehatan, seperti sistem kekebalan tubuh yang lemah, risiko osteoporosis, dan gangguan menstruasi pada perempuan. Untuk menjaga kesehatan dan kualitas hidup Anda, disarankan untuk memeriksakan kondisi Anda ke profesional kesehatan seperti dokter atau ahli gizi. Mereka dapat memberikan saran yang tepat untuk peningkatan berat badan Anda yang sehat dan seimbang, yang melibatkan asupan nutrisi yang cukup dan olahraga yang tepat. Selalu ingat, sehat bukan hanya soal angka di timbangan, tetapi juga tentang bagaimana Anda merasa baik dan bugar dalam melakukan aktivitas sehari-hari.";
        } elseif ($bmi >= 18.5 and $bmi <= 24.9) {
            $statusBMI = "Normal";
            $keteranganBMI = "Anda berada dalam kategori Normal. Ini berarti berat badan Anda berada dalam rentang yang sehat untuk tinggi badan Anda. Memiliki berat badan dalam kisaran normal dapat menurunkan risiko Anda terhadap berbagai masalah kesehatan, seperti penyakit jantung, tekanan darah tinggi, dan diabetes tipe 2. Meski berada dalam kategori ini, penting untuk menjaga gaya hidup sehat dan seimbang. Olahraga secara teratur, makan makanan seimbang yang kaya nutrisi, dan menjaga pola tidur yang baik adalah beberapa cara untuk mempertahankan berat badan dan kesehatan Anda. Selalu ingat bahwa sehat bukan hanya tentang berat badan, tetapi juga tentang merasa baik dan bugar dalam melakukan aktivitas sehari-hari Anda. Jika Anda memiliki pertanyaan atau kekhawatiran tentang berat badan atau kesehatan Anda, diskusikan dengan dokter atau ahli gizi.";
        } elseif ($bmi >= 25 and $bmi <= 29.9) {
            $statusBMI = "Overweight";
            $keteranganBMI = "Anda berada dalam kategori Pre-obesitas. Pre-obesitas berarti berat badan Anda sedikit lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Meskipun ini bukan obesitas, kategori ini tetap menunjukkan risiko kesehatan yang lebih tinggi jika dibandingkan dengan berat badan normal. Kondisi pre-obesitas dapat meningkatkan risiko Anda terhadap penyakit jantung, tekanan darah tinggi, diabetes tipe 2, dan masalah kesehatan lainnya. Untuk mengurangi risiko tersebut, sangat penting bagi Anda untuk mencoba menurunkan berat badan ke dalam kisaran yang sehat. Ini bisa dilakukan melalui peningkatan aktivitas fisik dan pola makan sehat yang seimbang. Mencapai dan mempertahankan berat badan yang sehat bukan hanya tentang penampilan, tetapi juga tentang memelihara kesehatan dan kualitas hidup Anda. Diskusikan dengan profesional kesehatan seperti dokter atau ahli gizi untuk mendapatkan rencana penurunan berat badan yang sehat dan berkelanjutan.";
        } else {
            $statusBMI = "Obesitas";
            $keteranganBMI = "Anda berada dalam kategori Obesitas. Obesitas berarti berat badan Anda secara signifikan lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Kondisi ini menimbulkan risiko kesehatan yang serius, termasuk penyakit jantung, diabetes tipe 2, tekanan darah tinggi, dan beberapa jenis kanker. Dalam beberapa kasus, obesitas juga dapat mempengaruhi kualitas hidup Anda dan dapat menyebabkan masalah psikologis seperti penurunan rasa percaya diri dan depresi. Sangat penting bagi Anda untuk memulai langkah-langkah penurunan berat badan yang sehat dan berkelanjutan. Hal ini dapat dicapai dengan membuat perubahan gaya hidup, seperti meningkatkan aktivitas fisik dan menjalankan pola makan seimbang. Selalu diskusikan rencana kesehatan Anda dengan dokter atau ahli gizi profesional untuk mendapatkan pendekatan terbaik dalam mencapai dan mempertahankan berat badan yang sehat. Ingatlah, perjalanan ini bukan tentang penurunan berat badan semata, tetapi tentang peningkatan kesehatan dan kualitas hidup secara keseluruhan.";
        }

        BMI::create([
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'bmi' => $bmi,
            'status' => $statusBMI,
            'keterangan' => $keteranganBMI,
            'user_id' => $userData->id
        ]);

        // Hitung BMR
        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'];
        $usia = (float)$request['usia'];
        $bmr = 0;

        if ($request['jenis_kelamin'] === "L") {
            $bmr = round(66.5 + (13.7 * $berat_badan) + (5 * $tinggi_badan) - (6.8 * $usia), 2);
        }

        if ($request['jenis_kelamin'] === "P") {
            $bmr = round(655 + (9.6 * $berat_badan) + (1.8 * $tinggi_badan) - (4.7 * $usia), 2);
        }

        BMR::create([
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tinggi_badan' =>  $tinggi_badan,
            'berat_badan' => $berat_badan,
            'usia' =>  $usia,
            'bmr' => $bmr,
            'status' => 'belum dibuat',
            'user_id' => $userData->id,
        ]);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
            ],
            'data' => $userData,
        ], 200);
    }
}
