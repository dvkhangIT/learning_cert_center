<?php

namespace App\Http\Controllers\quan_ly;

use App\DataTables\LoaiChungChiDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChungChi;
use App\Models\LoaiChungChi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoaiChungChiController extends Controller
{
    public function danhSachLoaiChungChi(LoaiChungChiDataTable $datatable)
    {
        return $datatable->render('quan_ly.loai_chung_chi.danh_sach_chung_loai_chi');
    }
    public function formTaoLoaiChungChi()
    {
        return view('quan_ly.loai_chung_chi.tao_loai_chung_chi');
    }
    public function luuLoaiChungChi(Request $request)
    {
        // $request->validate([
        //     'ten_loai_cc' => 'required|string|min:10|max:100|unique:loai_chung_chi,ten_loai_cc',
        //     'cau_hinh_diem[]' => 'nullable|array'
        // ], [
        //     'ten_loai_cc.required' => 'Vui lòng nhập tên loại chứng chỉ.',
        //     'ten_loai_cc.string' => 'Tên loại chứng chỉ phải là chuỗi.',
        //     'ten_loai_cc.min' => 'Tên loại chứng chỉ phải có ít nhất :min ký tự.',
        //     'ten_loai_cc.max' => 'Tên loại chứng chỉ không được vượt quá :max ký tự.',
        //     'ten_loai_cc.unique' => 'Tên loại chứng chỉ đã tồn tại.',
        //     'cau_hinh_diem.array'  => 'Cấu hình điểm phải là một danh sách.',
        //     'cau_hinh_diem.*.in'   => 'Ccấu hình điểm không hợp lệ.',

        // ]);
        $request->validate([
            'ten_loai_cc' => [
                'required',
                'string',
                'min:10',
                'max:100',
                'unique:loai_chung_chi,ten_loai_cc'
            ],
            'cau_hinh_diem'   => 'required|array|min:2',
            'cau_hinh_diem.*' => 'in:diem_nghe,diem_noi,diem_doc,diem_viet',
        ], [
            'ten_loai_cc.required' => 'Vui lòng nhập tên loại chứng chỉ.',
            'ten_loai_cc.string' => 'Tên loại chứng chỉ phải là chuỗi.',
            'ten_loai_cc.min' => 'Tên loại chứng chỉ phải có ít nhất :min ký tự.',
            'ten_loai_cc.max' => 'Tên loại chứng chỉ không được vượt quá :max ký tự.',
            'ten_loai_cc.unique' => 'Tên loại chứng chỉ đã tồn tại.',

            'cau_hinh_diem.required' => 'Vui lòng chọn ít nhất hai cấu hình điểm.',
            'cau_hinh_diem.array'    => 'Cấu hình điểm phải là một danh sách.',
            'cau_hinh_diem.min'      => 'Bạn phải chọn ít nhất hai cấu hình điểm.',
            'cau_hinh_diem.*.in'     => 'Giá trị cấu hình điểm không hợp lệ.',

        ]);
        $loaiChungChi = new LoaiChungChi();
        $loaiChungChi->ten_loai_cc = $request->ten_loai_cc;
        $loaiChungChi->cau_hinh_diem = $request->cau_hinh_diem;
        $loaiChungChi->save();
        toastr()->success('Tạo loại chứng chỉ thành công!', ' ');
        return redirect()->route('quan-ly.loai-chung-chi.danh-sach-loai-chung-chi');
    }
    public function formSuaLoaiChungChi(string $ma_loai_cc)
    {
        $loaiChungChi = LoaiChungChi::findOrFail($ma_loai_cc);
        return view('quan_ly.loai_chung_chi.sua_loai_chung_chi', compact('loaiChungChi'));
    }
    public function suaLoaiChungChi(Request $request, string $ma_loai_cc)
    {
        $request->validate([
            'ten_loai_cc' => [
                'required',
                'string',
                'min:10',
                'max:100',
                Rule::unique('loai_chung_chi', 'ten_loai_cc')
                    ->ignore($ma_loai_cc, 'ma_loai_cc')
            ],
            'cau_hinh_diem'   => 'required|array|min:2',
            'cau_hinh_diem.*' => 'in:diem_nghe,diem_noi,diem_doc,diem_viet',
        ], [
            'ten_loai_cc.required' => 'Vui lòng nhập tên loại chứng chỉ.',
            'ten_loai_cc.string' => 'Tên loại chứng chỉ phải là chuỗi.',
            'ten_loai_cc.min' => 'Tên loại chứng chỉ phải có ít nhất :min ký tự.',
            'ten_loai_cc.max' => 'Tên loại chứng chỉ không được vượt quá :max ký tự.',
            'ten_loai_cc.unique' => 'Tên loại chứng chỉ đã tồn tại.',

            'cau_hinh_diem.required' => 'Vui lòng chọn ít nhất hai cấu hình điểm.',
            'cau_hinh_diem.array'    => 'Cấu hình điểm phải là một danh sách.',
            'cau_hinh_diem.min'      => 'Bạn phải chọn ít nhất hai cấu hình điểm.',
            'cau_hinh_diem.*.in'     => 'Giá trị cấu hình điểm không hợp lệ.',
        ]);
        $loaiChungChi =  LoaiChungChi::findOrFail($ma_loai_cc);
        $loaiChungChi->ten_loai_cc = $request->ten_loai_cc;
        $loaiChungChi->cau_hinh_diem = $request->cau_hinh_diem;
        $loaiChungChi->save();
        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('quan-ly.loai-chung-chi.danh-sach-loai-chung-chi');
    }
    public function xoaLoaiChungChi(string $ma_loai_cc)
    {
        $loaiChungChi =  LoaiChungChi::findOrFail($ma_loai_cc);
        $countChungChi = ChungChi::where('ma_loai_cc', $loaiChungChi->ma_loai_cc)->count();
        if ($countChungChi > 0) {
            return response()->json(['status' => 'error', 'message' => 'Không thể xóa loại chứng chỉ này vì đang có chứng chỉ phụ thuộc.']);
        }
        $loaiChungChi->delete();
        return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
    }
}
