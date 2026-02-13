<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>تأیید ایمیل</title>
    <style>
       
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: #f4f6f8;
            direction: rtl;
            font-family: 'Vazirmatn', Tahoma, "Segoe UI", Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 500px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 50%
        }

        h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        p {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .verify-btn {
            display: inline-block;
            padding: 14px 32px;
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 0 rgb(13, 110, 253, 0.6);
            animation: pulseShadow 1.8s infinite;
            transition: all 1s;
        }

        .verify-btn:hover {
            background-color: #085ae9;
        }

        @keyframes pulseShadow {
            0% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.6);
            }

            70% {
                box-shadow: 0 0 0 18px rgba(13, 110, 253, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
            }
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #999;
        }

        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .code-box {
            font-size: 24px;
            letter-spacing: 5px;
            padding: 15px 20px;
            margin: 10px 0;
            border: 2px dashed #ccc;
            border-radius: 5px;
            display: inline-block;
            user-select: all;
            /* کاربر راحت کپی کنه */
        }

        .btn-copy {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        @component('components.logo')
        @endcomponent
        <div style="width: 100%;">
            <h2 style="margin-bottom: 2px ;margin-top: 0px;">کد تایید شما</h2>
            <p style="margin-top: 15px;">برای تایید هویت خود کد زیر را وارد کنید</p>
            <div class="code-box" style="margin-top: 20px;direction: ltr;" id="verificationCode">{{ $code }}</div>
            <br>
            <div class="footer">
                © فدراسیون بسکتبال استان تهران
            </div>
        </div>


    </div>
</body>

</html>