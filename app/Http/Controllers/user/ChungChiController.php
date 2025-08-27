<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChungChi;
use App\Models\KetQua;
use Illuminate\Support\Facades\Validator;

class ChungChiController extends Controller
{
    public function traCuuForm()
    {
        return view('user.chung_chi.tra_cuu');
    }

    public function traCuu(Request $request)
    {
        $request->validate([
            'so_hieu' => 'nullable|string',
            'so_vao_so' => 'nullable|string',
        ]);

        $q = ChungChi::with(['hocVien', 'ketQua', 'loaiChungChi']);

        if ($request->so_hieu) $q->where('so_hieu', $request->so_hieu);
        if ($request->so_vao_so) $q->where('so_vao_so', $request->so_vao_so);

        $results = $q->get();

        return view('user.chung_chi.tra_cuu', compact('results'));
    }

    public function show(string $ma_cc)
    {
        $chungChi = ChungChi::with(['hocVien', 'ketQua', 'loaiChungChi'])->findOrFail($ma_cc);
        return view('user.chung_chi.show', compact('chungChi'));
    }

    public function formNhapDiem(string $ma_cc)
    {
        $chungChi = ChungChi::with(['loaiChungChi', 'ketQua'])->findOrFail($ma_cc);
        $cacMaDiemCanThiet = $chungChi->loaiChungChi->cau_hinh_diem ?? [];
        $danhSachTenDiem = [
            'diem_nghe' => 'Điểm nghe',
            'diem_doc' => 'Điểm đọc',
            'diem_noi' => 'Điểm nói',
            'diem_viet' => 'Điểm viết',
            'diem_tu_vung' => 'Điểm từ vựng',
            'diem_ngu_phap_doc' => 'Điểm ngữ pháp - đọc',
            'diem_trac_nghiem' => 'Điểm trắc nghiệm',
            'diem_thuc_hanh' => 'Điểm thực hành',
        ];
        $cacLoaiDiem = [];
        foreach ($cacMaDiemCanThiet as $ma) {
            if (isset($danhSachTenDiem[$ma])) $cacLoaiDiem[$ma] = $danhSachTenDiem[$ma];
        }

        return view('user.chung_chi.nhap_diem', compact('chungChi', 'cacLoaiDiem'));
    }

    public function luuNhapDiem(Request $request, string $ma_cc)
    {
        $chungChi = ChungChi::with('loaiChungChi','hocVien')->findOrFail($ma_cc);
        $tenLoaiCC = $chungChi->loaiChungChi->ten_loai_cc ?? null;

        // build rules/messages like admin's KetQuaController::suaKetQua
        $rules = [];
        $messages = [];
        switch ($tenLoaiCC) {
            case 'Chứng nhận năng lực tiếng Anh CTUT':
                $rules['diem_nghe'] = 'required|numeric|min:0|max:500';
                $rules['diem_doc'] = 'required|numeric|min:0|max:500';
                $messages = [
                    'diem_nghe.required' => 'Vui lòng nhập điểm nghe.',
                    'diem_doc.required' => 'Vui lòng nhập điểm đọc.',
                    'diem_nghe.numeric' => 'Điểm nghe phải là số.',
                    'diem_doc.numeric' => 'Điểm đọc phải là số.',
                ];
                break;

            case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
                $rules = [
                    'diem_nghe' => 'required|numeric|min:0|max:10',
                    'diem_noi'  => 'required|numeric|min:0|max:10',
                    'diem_doc'  => 'required|numeric|min:0|max:10',
                    'diem_viet' => 'required|numeric|min:0|max:10',
                ];
                $messages['*.required'] = 'Vui lòng nhập :attribute.';
                break;

            case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
                $rules = [
                    'diem_tu_vung' => 'required|numeric|min:0|max:60',
                    'diem_ngu_phap_doc' => 'required|numeric|min:0|max:60',
                    'diem_nghe' => 'required|numeric|min:0|max:60',
                ];
                $messages['*.required'] = 'Vui lòng nhập :attribute.';
                break;

            case 'Chứng chỉ ứng dụng CNTT cơ bản':
                $rules = [
                    'diem_trac_nghiem' => 'required|numeric|min:0|max:10',
                    'diem_thuc_hanh' => 'required|numeric|min:0|max:10',
                ];
                $messages['*.required'] = 'Vui lòng nhập :attribute.';
                break;

            default:
                // nếu không biết loại -> yêu cầu ít nhất 1 điểm
                $rules['diem_trac_nghiem'] = 'nullable|numeric';
        }

        $attributes = [
            'diem_nghe' => 'điểm nghe',
            'diem_noi' => 'điểm nói',
            'diem_doc' => 'điểm đọc',
            'diem_viet' => 'điểm viết',
            'diem_tu_vung' => 'điểm từ vựng',
            'diem_ngu_phap_doc' => 'điểm ngữ pháp - đọc',
            'diem_trac_nghiem' => 'điểm trắc nghiệm',
            'diem_thuc_hanh' => 'điểm thực hành',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // build data to save
        $data = [];
        foreach (['diem_nghe','diem_noi','diem_doc','diem_viet','diem_tu_vung','diem_ngu_phap_doc','diem_trac_nghiem','diem_thuc_hanh'] as $f) {
            if ($request->has($f)) $data[$f] = $request->input($f);
        }

        // compute trang_thai
        $trangThai = $this->computeTrangThai($tenLoaiCC, $data);
        $data['trang_thai'] = $trangThai;
        $data['ma_cc'] = $chungChi->ma_cc;
        $data['ma_hv'] = $chungChi->ma_hv ?? null;

        // create new KetQua
        $ketQua = new KetQua();
        // ensure ma_cc, ma_hv exist in $fillable or set directly:
        foreach ($data as $k => $v) $ketQua->$k = $v;
        $ketQua->save();

        toastr()->success('Nhập điểm thành công!', ' ');
        return redirect()->route('nhan-vien.chung-chi.show', $chungChi->ma_cc);
    }

    /**
     * Compute trang_thai (Đạt / Không đạt / Chưa xét) based on type and scores.
     * Adjust thresholds if your document gives other numbers.
     */
    private function computeTrangThai($tenLoai, $scores)
    {
        if (!$tenLoai) return 'Chưa xét';
        switch ($tenLoai) {
            case 'Chứng nhận năng lực tiếng Anh CTUT':
                $nghe = $scores['diem_nghe'] ?? 0;
                $doc = $scores['diem_doc'] ?? 0;
                return ($nghe >= 225 && $doc >= 225) ? 'Đạt' : 'Không đạt';

            case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
                $fields = ['diem_nghe','diem_noi','diem_doc','diem_viet'];
                foreach ($fields as $f) if (($scores[$f] ?? 0) < 5) return 'Không đạt';
                return 'Đạt';

            case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
                $fields = ['diem_tu_vung','diem_ngu_phap_doc','diem_nghe'];
                foreach ($fields as $f) if (($scores[$f] ?? 0) < 30) return 'Không đạt';
                return 'Đạt';

            case 'Chứng chỉ ứng dụng CNTT cơ bản':
                return (($scores['diem_trac_nghiem'] ?? 0) >= 5 && ($scores['diem_thuc_hanh'] ?? 0) >= 5) ? 'Đạt' : 'Không đạt';

            default:
                return 'Chưa xét';
        }
    }

    public function inPdf(string $ma_cc)
    {
        $chungChi = ChungChi::with(['hocVien','ketQua','loaiChungChi'])->findOrFail($ma_cc);
        if (!$chungChi->ketQua || ($chungChi->ketQua->trang_thai ?? '') !== 'Đạt') {
            toastr()->error('Chứng chỉ chưa đạt, không thể in.', ' ');
            return redirect()->back();
        }

        // Ensure barryvdh/laravel-dompdf is installed and configured
        $pdf = \PDF::loadView('user.chung_chi.pdf', compact('chungChi'));
        return $pdf->stream("chungchi_{$chungChi->so_hieu}.pdf");
    }
}
