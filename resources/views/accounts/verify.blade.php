@extends('layout.initialize')
@section('title')
    کد تایید
@endsection
@section('body')
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            font-family: 'Vazirmatn', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        * {
            margin: 0px;
            padding: 0px;
        }

        .card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.95);
            text-align: center;
        }

        .form-control {
            border-radius: 15px;
            padding: 15px;
            text-align: center;
        }

        .btn-primary {
            border-radius: 15px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .timer {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.1rem;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            transition: color 0.3s;
        }

        a:hover {
            color: #1d6fa5;
        }

        #otp::-webkit-outer-spin-button,
        #otp::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        #otp {
            -moz-appearance: textfield;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/polipop.min.css') }}" />
    <script src="{{ asset('js/polipop.min.js') }}"></script>
    <script>
        var polipop = new Polipop('mypolipop', {
            layout: 'popups',
            pool: 3,
            life: 3000,
        });
    </script>
    <div class="card">
        <h2 class="mb-4">تایید کد ایمیل</h2>
        <p style="margin-bottom: 5px">
            کد تاییدی به ایمیل زیر ارسال شده است
        </p>
        <p style="margin-bottom: 4px">
            <span style="font-weight: bold">{{ $email }}</span>
        </p>
        <p>
            لطفا آن کد رو اینجا وارد کنید
        </p>
        <form method="POST" action="{{ url()->current() }}">
            @csrf
            <div class="mb-3 px-3">
                <input type="number" autocomplete="off" inputmode="numeric" pattern="[0-9]*" name="code"
                    style="font-size: 24px;letter-spacing: 12px;padding: 12px" id="otp" max="99999"
                    class="form-control" placeholder="کد تایید">
            </div>
            <div class="px-4 ">
                <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                    type="submit">تایید کد</button>
            </div>
        </form>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <a href="{{ $back }}">تغییر ایمیل / بازگشت</a>
            <span id="timer" class="timer">00:00</span>
        </div>
    </div>

    <script>
        let timeLeft = @json($time);
        let back = @json($back);
        const timerEl = document.getElementById('timer');

        function updateTimer() {
            if (timeLeft <= 0) {
                // window.location.href = back;
                timerEl.textContent = `00:00`;
                return
            };
            let minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            let seconds = (timeLeft % 60).toString().padStart(2, '0');
            timerEl.textContent = `${minutes}:${seconds}`;
            timeLeft--;
        }

        setInterval(updateTimer, 1000);

        const otp = document.getElementById("otp");

        otp.addEventListener("input", () => {
            otp.value = otp.value.replace(/\D/g, "").slice(0, 5).trim();
        });

        const loader =
            `<div class="spinner-border text-white" role="status"><span class="visually-hidden">Loading...</span></div>`
        const btn = document.querySelector("form button[type~=submit]");
        const btnText = btn.innerHTML;
        const form = document.querySelector("form");
        const action = form.action;
        const host = window.location.host;
        
        const endLoading = () => {
            btn.innerHTML = btnText
        };
        btn.addEventListener("click", () => {
            btn.innerHTML = loader;
        })

        const messagesRes = @json(session('messages'));
        const messages = JSON.parse(messagesRes);

        if (Array.isArray(messages)) {
            messages.forEach((message) => {
                polipop.add(message);
            })
        } else {
            polipop.add(messages);
        }
    </script>
@endsection
