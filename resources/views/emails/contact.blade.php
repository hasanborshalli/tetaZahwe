<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Contact Message — Teta Zahwe</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #1C1412;
        }

        .wrap {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
        }

        .header {
            background: #1C1412;
            padding: 36px 40px;
        }

        .header-logo {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        .header-logo span {
            color: #C9728A;
        }

        .header-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .pink-bar {
            height: 3px;
            background: #C9728A;
        }

        .body {
            padding: 40px;
        }

        .tag {
            display: inline-block;
            background: #FBF5F6;
            color: #C9728A;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            color: #1C1412;
            margin-bottom: 8px;
        }

        .sub {
            font-size: 13px;
            color: #6B6060;
            margin-bottom: 32px;
        }

        .field {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #EDE5E7;
        }

        .field:last-of-type {
            border-bottom: none;
        }

        .field-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #ADADAD;
            margin-bottom: 6px;
        }

        .field-value {
            font-size: 15px;
            color: #1C1412;
            line-height: 1.6;
        }

        .message-box {
            background: #FBF5F6;
            border-left: 3px solid #C9728A;
            padding: 20px 24px;
            border-radius: 0 4px 4px 0;
            margin-top: 8px;
        }

        .message-box p {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            margin: 0;
        }

        .footer-bar {
            background: #f9f4f5;
            padding: 24px 40px;
            text-align: center;
        }

        .footer-bar p {
            font-size: 11px;
            color: #ADADAD;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .btn {
            display: inline-block;
            background: #C9728A;
            color: #fff;
            padding: 12px 28px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            margin-top: 28px;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="header">
            <div class="header-logo">Teta <span>Zahwe</span></div>
            <div class="header-sub">Catering · New Message</div>
        </div>
        <div class="pink-bar"></div>

        <div class="body">
            <div class="tag">📩 New Contact Message</div>
            <div class="title">You have a new enquiry</div>
            <div class="sub">Received {{ now()->format('l, F j, Y \a\t g:i A') }}</div>

            <div class="field">
                <div class="field-label">From</div>
                <div class="field-value">{{ $contactMessage->name }}</div>
            </div>

            <div class="field">
                <div class="field-label">Phone</div>
                <div class="field-value">
                    <a href="tel:{{ $contactMessage->phone }}" style="color:#C9728A;">{{ $contactMessage->phone }}</a>
                </div>
            </div>

            @if($contactMessage->email)
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value">
                    <a href="mailto:{{ $contactMessage->email }}" style="color:#C9728A;">{{ $contactMessage->email
                        }}</a>
                </div>
            </div>
            @endif

            @if($contactMessage->event_type)
            <div class="field">
                <div class="field-label">Event Type</div>
                <div class="field-value">{{ $contactMessage->event_type }}</div>
            </div>
            @endif

            @if($contactMessage->event_date)
            <div class="field">
                <div class="field-label">Preferred Date</div>
                <div class="field-value">{{ $contactMessage->event_date->format('F j, Y') }}</div>
            </div>
            @endif

            <div class="field">
                <div class="field-label">Message</div>
                <div class="message-box">
                    <p>{{ $contactMessage->message }}</p>
                </div>
            </div>

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" class="btn">
                Reply via WhatsApp →
            </a>
        </div>

        <div class="footer-bar">
            <p>This email was sent from the contact form on tetazahwe.com</p>
            <p style="margin-top:6px;">© {{ date('Y') }} Teta Zahwe Catering · Beirut, Lebanon</p>
        </div>
    </div>
</body>

</html>