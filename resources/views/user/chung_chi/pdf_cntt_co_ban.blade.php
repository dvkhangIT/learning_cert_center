<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Chứng chỉ {{ $chungChi->so_hieu }}</title>
  <style>
    body { 
      font-family: DejaVu Sans, sans-serif; 
      padding: 30px; 
      margin: 0;
      background-color: #fefefe;
    }
    .certificate-container {
      border: 3px solid #2c3e50;
      padding: 40px;
      position: relative;
      min-height: 800px;
      max-height: 800px;
      background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%), 
                  linear-gradient(-45deg, #f8f9fa 25%, transparent 25%), 
                  linear-gradient(45deg, transparent 75%, #f8f9fa 75%), 
                  linear-gradient(-45deg, transparent 75%, #f8f9fa 75%);
      background-size: 20px 20px;
      background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
    }
    .header {
      text-align: center;
      margin-bottom: 30px;
    }
    .vietnam-header {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 2px;
    }
    .motto {
      font-size: 14px;
      margin-bottom: 15px;
    }
    .certificate-title {
      font-size: 32px;
      font-weight: bold;
      color: #e74c3c;
      margin-bottom: 8px;
      text-transform: uppercase;
    }
    .certificate-type {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 3px;
    }
    .university-name {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 25px;
    }
    .logo {
      position: absolute;
      top: 40px;
      left: 40px;
      width: 80px;
      height: 80px;
    }
    .logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    .content {
      margin-left: 50px;
      margin-right: 50px;
    }
    .recipient-info {
      margin-bottom: 20px;
    }
    .info-row {
      margin-bottom: 10px;
      font-size: 16px;
      display: flex;
      align-items: baseline;
    }
    .info-label {
      font-weight: bold;
      min-width: 120px;
      flex-shrink: 0;
    }
    .info-value {
      margin-left: 10px;
    }
    .description {
      text-align: justify;
      margin-bottom: 15px;
      font-size: 16px;
      line-height: 1.4;
    }
    .exam-location {
      text-align: justify;
      margin-bottom: 20px;
      font-size: 16px;
      line-height: 1.4;
    }
    .results {
      margin-bottom: 20px;
    }
    .results-title {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 10px;
    }
    .result-row {
      margin-bottom: 8px;
      font-size: 16px;
      display: flex;
      align-items: baseline;
    }
    .result-label {
      font-weight: bold;
      min-width: 170px;
      flex-shrink: 0;
    }
    .footer {
      position: absolute;
      bottom: 120px;
      left: 40px;
      right: 40px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }
    .issue-date {
      text-align: right;
      margin-bottom: 15px;
      font-size: 16px;
    }
    .signature-section {
      text-align: right;
    }
    .signature-title {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 20px;
    }
    .certificate-number {
      font-size: 14px;
      text-align: left;
    }
    .serial-number {
      font-weight: bold;
      color: #e74c3c;
    }
  </style>
</head>
<body>
  <div class="certificate-container">
    <div class="logo">
      <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo">
    </div>
    
    <div class="header">
      <div class="vietnam-header">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</div>
      <div class="motto">Độc lập - Tự do - Hạnh phúc</div>
      <div class="certificate-title">CHỨNG CHỈ</div>
      <div class="certificate-type">ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</div>
      <div class="university-name">TRƯỜNG ĐẠI HỌC KỸ THUẬT - CÔNG NGHỆ CẦN THƠ</div>
    </div>

    <div class="content">
      <div class="recipient-info">
        <div class="info-row">
          <span class="info-label">Cấp cho:</span>
          <span class="info-value">{{ $chungChi->hocVien->hoten_hv ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Sinh ngày:</span>
          <span class="info-value">{{ $chungChi->hocVien->ngay_sinh ? \Carbon\Carbon::parse($chungChi->hocVien->ngay_sinh)->format('d/m/Y') : 'N/A' }}</span>
          <span class="info-label">Nơi sinh:</span>
          <span class="info-value">{{ $chungChi->hocVien->noi_sinh ?? 'N/A' }}</span>
        </div>
      </div>

      <div class="description">
        Đạt yêu cầu bài thi ứng dụng công nghệ thông tin cơ bản tại Hội đồng thi:
      </div>

      <div class="exam-location">
        Trung tâm Ngoại ngữ - Tin học Trường Đại học Kỹ thuật - Công nghệ Cần Thơ
      </div>

      <div class="results">
        <div class="results-title">Kết quả:</div>
        <div class="result-row">
          <span class="result-label">Điểm trắc nghiệm:</span>
          <span style="margin-left: 10px;">{{ $chungChi->ketQua->diem_trac_nghiem ?? 'N/A' }}</span>
        </div>
        <div class="result-row">
          <span class="result-label">Điểm thực hành:</span>
          <span style="margin-left: 10px;">{{ $chungChi->ketQua->diem_thuc_hanh ?? 'N/A' }}</span>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="certificate-number">
        <div class="serial-number">Số hiệu: {{ $chungChi->so_hieu ?? 'N/A' }}</div>
        <div>Số vào số cấp chứng chỉ: {{ $chungChi->so_vao_so ?? 'N/A' }}</div>
      </div>
      <div class="signature-section">
        <div class="issue-date">
          Cần Thơ ngày {{ now()->format('d') }} tháng {{ now()->format('m') }} năm {{ now()->format('Y') }}
        </div>
        <div class="signature-title">GIÁM ĐỐC</div>
        <div style="margin-top: 20px;">____________________</div>
      </div>
    </div>
  </div>
</body>
</html>
