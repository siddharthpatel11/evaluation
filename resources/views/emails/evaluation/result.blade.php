<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluation Result</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f4f7f6;
            padding: 40px 20px;
        }

        .container {
            max-width: 750px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
            background-color: #2563eb;
            /* Professional Corporate Blue */
        }

        .header-icon {
            font-size: 50px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 40px 30px;
            color: #333333;
        }

        .greeting {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1a1a1a;
        }

        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #555555;
        }

        .details-box {
            background-color: #fafafa;
            border: 1px solid #eeeeee;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .detail-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eeeeee;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #888888;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            font-size: 15px;
            color: #222222;
            font-weight: 500;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #2563eb;
        }

        .score-box {
            text-align: left;
        }

        .score-label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .score-value {
            font-size: 24px;
            font-weight: 700;
            color: #111;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pass {
            background-color: #e6f4ea;
            color: #1e8e3e;
        }

        .badge-fail {
            background-color: #fce8e6;
            color: #d93025;
        }

        .list-items {
            margin: 10px 0 0 0;
            padding-left: 20px;
            color: #444;
        }

        .list-items li {
            margin-bottom: 6px;
        }

        .image-tag {
            display: inline-block;
            padding: 5px 10px;
            background-color: #eef2f5;
            border-radius: 4px;
            margin-right: 6px;
            margin-top: 6px;
            font-size: 12px;
            color: #5f6368;
            border: 1px solid #dadce0;
        }

        .footer {
            text-align: center;
            padding: 30px 20px;
            font-size: 13px;
            color: #999999;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="container">
            <!-- Header section with a common professional color -->
            <div class="header">
                <div class="header-icon">📊</div>
                <h1>Evaluation Result</h1>
            </div>

            <div class="content">
                <div class="greeting">Hello, {{ $submission->name }}!</div>

                <div class="message">
                    Thank you for completing the evaluation. Your performance has been recorded, and you can find your
                    detailed results below.
                </div>

                <!-- Submission Details -->
                <div class="details-box">
                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $submission->email }}</span>
                    </div>

                    @if ($submission->description)
                        <div class="detail-row">
                            <span class="detail-label">Description</span>
                            <div class="detail-value" style="font-weight: normal; margin-top: 5px;">
                                {!! $submission->description !!}
                            </div>
                        </div>
                    @endif

                    @if (!empty($submission->issues))
                        <div class="detail-row">
                            <span class="detail-label">Issues</span>
                            <div class="detail-value">
                                <ul class="list-items">
                                    @foreach ($submission->issues as $issue)
                                        <li>{{ $issue }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (!empty($submission->images))
                        <div class="detail-row">
                            <span class="detail-label">Attachments</span>
                            <div class="detail-value" style="margin-top: 5px;">
                                @foreach ($submission->images as $index => $imagePath)
                                    <span class="image-tag">&#128206; Image {{ $index + 1 }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Score & Status Section (Moved to Bottom) -->
                <div class="score-container">
                    <div class="score-box">
                        <span class="score-label">Marks Obtained</span>
                        <div class="score-value">{{ $submission->marks_obtained }} <span
                                style="font-size:16px; color:#888;">/ {{ $submission->max_marks }}</span></div>
                    </div>
                    <div>
                        <span
                            class="badge {{ $status === 'Pass' ? 'badge-pass' : 'badge-fail' }}">{{ $status }}</span>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Evaluation System. All rights reserved.</p>
                <p>This is an automated message, please do not reply.</p>
            </div>
        </div>
    </div>
</body>

</html>
