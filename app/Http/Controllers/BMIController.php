<?php

namespace App\Http\Controllers;

use App\Http\Resources\BMIResource;
use App\Models\BMI;
use App\Models\BMR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BMIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId =  Auth::user()->id;
        $bmi = BMI::where('user_id', '=',  $currentUserId)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $bmi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tinggi_badan' => ['string', 'min:1', 'required'],
            'berat_badan' => ['string', 'min:1', 'required'],
        ]);

        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'] / 100;
        $bmi =  round($berat_badan / ($tinggi_badan * $tinggi_badan), 2);
        $status = "";
        $keterangan = '';

        if ($bmi <= 18.5) {
            $status = "Underweight";
            $keterangan = "Anda masuk dalam kategori Underweight atau berat badan kurang. BMI Underweight berarti bahwa berat badan Anda lebih rendah dari yang seharusnya berdasarkan tinggi badan Anda. Kondisi ini dapat berpotensi menimbulkan berbagai masalah kesehatan, seperti sistem kekebalan tubuh yang lemah, risiko osteoporosis, dan gangguan menstruasi pada perempuan. Untuk menjaga kesehatan dan kualitas hidup Anda, disarankan untuk memeriksakan kondisi Anda ke profesional kesehatan seperti dokter atau ahli gizi. Mereka dapat memberikan saran yang tepat untuk peningkatan berat badan Anda yang sehat dan seimbang, yang melibatkan asupan nutrisi yang cukup dan olahraga yang tepat. Selalu ingat, sehat bukan hanya soal angka di timbangan, tetapi juga tentang bagaimana Anda merasa baik dan bugar dalam melakukan aktivitas sehari-hari.";
        } elseif ($bmi >= 18.5 and $bmi <= 24.9) {
            $status = "Normal";
            $keterangan = "Anda berada dalam kategori Normal. Ini berarti berat badan Anda berada dalam rentang yang sehat untuk tinggi badan Anda. Memiliki berat badan dalam kisaran normal dapat menurunkan risiko Anda terhadap berbagai masalah kesehatan, seperti penyakit jantung, tekanan darah tinggi, dan diabetes tipe 2. Meski berada dalam kategori ini, penting untuk menjaga gaya hidup sehat dan seimbang. Olahraga secara teratur, makan makanan seimbang yang kaya nutrisi, dan menjaga pola tidur yang baik adalah beberapa cara untuk mempertahankan berat badan dan kesehatan Anda. Selalu ingat bahwa sehat bukan hanya tentang berat badan, tetapi juga tentang merasa baik dan bugar dalam melakukan aktivitas sehari-hari Anda. Jika Anda memiliki pertanyaan atau kekhawatiran tentang berat badan atau kesehatan Anda, diskusikan dengan dokter atau ahli gizi.";
        } elseif ($bmi >= 25 and $bmi <= 29.9) {
            $status = "Pre-obesitas";
            $keterangan = "Anda berada dalam kategori Pre-obesitas. Pre-obesitas berarti berat badan Anda sedikit lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Meskipun ini bukan obesitas, kategori ini tetap menunjukkan risiko kesehatan yang lebih tinggi jika dibandingkan dengan berat badan normal. Kondisi pre-obesitas dapat meningkatkan risiko Anda terhadap penyakit jantung, tekanan darah tinggi, diabetes tipe 2, dan masalah kesehatan lainnya. Untuk mengurangi risiko tersebut, sangat penting bagi Anda untuk mencoba menurunkan berat badan ke dalam kisaran yang sehat. Ini bisa dilakukan melalui peningkatan aktivitas fisik dan pola makan sehat yang seimbang. Mencapai dan mempertahankan berat badan yang sehat bukan hanya tentang penampilan, tetapi juga tentang memelihara kesehatan dan kualitas hidup Anda. Diskusikan dengan profesional kesehatan seperti dokter atau ahli gizi untuk mendapatkan rencana penurunan berat badan yang sehat dan berkelanjutan.";
        } else {
            $status = "Obesitas";
            $keterangan = "Anda berada dalam kategori Obesitas. Obesitas berarti berat badan Anda secara signifikan lebih tinggi dari yang dianggap sehat untuk tinggi badan Anda. Kondisi ini menimbulkan risiko kesehatan yang serius, termasuk penyakit jantung, diabetes tipe 2, tekanan darah tinggi, dan beberapa jenis kanker. Dalam beberapa kasus, obesitas juga dapat mempengaruhi kualitas hidup Anda dan dapat menyebabkan masalah psikologis seperti penurunan rasa percaya diri dan depresi. Sangat penting bagi Anda untuk memulai langkah-langkah penurunan berat badan yang sehat dan berkelanjutan. Hal ini dapat dicapai dengan membuat perubahan gaya hidup, seperti meningkatkan aktivitas fisik dan menjalankan pola makan seimbang. Selalu diskusikan rencana kesehatan Anda dengan dokter atau ahli gizi profesional untuk mendapatkan pendekatan terbaik dalam mencapai dan mempertahankan berat badan yang sehat. Ingatlah, perjalanan ini bukan tentang penurunan berat badan semata, tetapi tentang peningkatan kesehatan dan kualitas hidup secara keseluruhan.";
        }

        $bmi_data = BMI::create([
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'bmi' => $bmi,
            'status' => $status,
            'keterangan' => $keterangan,
            'user_id' => Auth::user()->id
        ]);

        return new BMIResource($bmi_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(BMI $bMI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BMI $bMI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BMI $bMI)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BMI $bMI)
    {
        //
    }
}
