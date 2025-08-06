<!DOCTYPE html>
<html lang="vi">

  <head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
  </head>

  <body
    style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div
      style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
      <h2 style="color: #333;">Xin chào {{ $name }},</h2>

      <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình.</p>
      <p>Vui lòng nhấn vào nút bên dưới để đặt lại mật khẩu:</p>

      <p style="text-align: center;">
        <a href="{{ route('form-khoi-phuc-mat-khau', $token) }}"
          style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Đặt
          lại mật khẩu</a>
      </p>

      <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>

      <p>Trân trọng,<br>Đội ngũ hỗ trợ {{ config('app.name') }}</p>
    </div>
  </body>

</html>
