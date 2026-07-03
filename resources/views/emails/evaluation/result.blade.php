<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Internship Evaluation Process and Next Steps</title>
    <style>
        body {
            font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            color: #374151;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #2563eb;
        }

        .header {
            padding: 30px 40px 15px;
            background-color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            letter-spacing: -0.5px;
        }

        .date-text {
            font-size: 13px;
            color: #6b7280;
            padding: 0 40px;
            text-align: right;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .content {
            padding: 20px 40px 30px;
            font-size: 15px;
            line-height: 1.6;
            color: #4b5563;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #111827;
        }

        p {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .details-box {
            background-color: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 25px;
            margin-top: 30px;
        }

        .details-title {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row {
            margin-bottom: 15px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            font-size: 15px;
            color: #1f2937;
            font-weight: 500;
        }

        .list-items {
            margin: 10px 0 0 0;
            padding-left: 20px;
            color: #4b5563;
        }

        .list-items li {
            margin-bottom: 6px;
        }

        .image-tag {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f3f4f6;
            border-radius: 4px;
            margin-right: 6px;
            margin-top: 6px;
            font-size: 12px;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .score-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 20px 25px;
            margin-top: 30px;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #2563eb;
        }

        .score-box {
            text-align: left;
        }

        .score-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            display: block;
            font-weight: 600;
        }

        .score-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pass {
            background-color: #ecfdf5;
            color: #10b981;
        }

        .badge-fail {
            background-color: #fef2f2;
            color: #ef4444;
        }

        .highlight-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
        }

        .status-pass {
            border-left-color: #10b981;
            background-color: #ecfdf5;
        }

        .status-fail {
            border-left-color: #ef4444;
            background-color: #fef2f2;
        }

        .status-title {
            font-weight: 700;
            margin-bottom: 5px;
            display: block;
            color: #1f2937;
        }

        .footer {
            padding: 30px 40px;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .signature {
            font-weight: 600;
            color: #1f2937;
            margin-top: 5px;
        }

        .contact-info {
            margin-top: 30px;
            font-size: 13px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="container">
            <div class="header">
                <h1>Excelsior Technologies</h1>
            </div>

            <div class="date-text">
                {{ now()->timezone('Asia/Kolkata')->format('D, d M Y g:i:s A O') }}
            </div>

            <div class="content">
                <div class="greeting">Dear {{ $submission->name ?? 'Candidate' }},</div>

                <p>Greetings from <strong>Excelsior Technologies</strong>.</p>

                <p>As discussed earlier, and as you are already aware, clearing the evaluation process is a mandatory
                    requirement to commence the internship. This evaluation is conducted to assess the skills gained
                    during the training phase, ensuring that live project work can be handled efficiently, within
                    defined timelines, and in alignment with required quality standards.</p>

                <p>The evaluation may be requested either <strong>during the training period or after the completion of
                        training</strong>, once you feel confident about your domain knowledge and clarity of basic
                    concepts.</p>

                <p>As per the evaluation criteria, a minimum score of <strong>70–80%</strong> is required to qualify for
                    the internship.</p>

                @php
                    $percentage =
                        isset($submission) && $submission->max_marks > 0
                            ? round(($submission->marks_obtained / $submission->max_marks) * 100)
                            : 0;

                    // Fallback to calculate percentage if marks_obtained is provided as percentage already (just in case)
                    if (isset($submission) && $submission->max_marks == 100) {
                        $percentage = $submission->marks_obtained;
                    }
                @endphp

                @if (isset($status) && $status === 'Pass')
                    <div class="highlight-box status-pass">
                        <span class="status-title">Evaluation Passed ({{ $percentage }}%)</span>
                        We are pleased to inform you that your recent assessment resulted in a qualifying score.
                        Congratulations on successfully clearing the evaluation process! You are now eligible to
                        commence your internship and begin working on live projects.
                    </div>

                    <p>We wish you the best in your internship and look forward to your continued growth and
                        performance.</p>
                @else
                    <div class="highlight-box status-fail">
                        <span class="status-title">Evaluation On Hold ({{ $percentage }}%)</span>
                        However, your recent assessment resulted in a score of @if (isset($submission) && $submission->marks_obtained == 0)
                            <strong>{{ $percentage }}% due to the use of AI during the evaluation</strong>, which was
                            strictly prohibited as per the assessment guidelines.@else{{ $percentage }}%, which does
                            not meet the minimum required criteria.
                        @endif
                    </div>

                    <p>As a result, your evaluation process has been placed on hold. <strong>You will not be eligible to
                            request or appear for a re-evaluation for a period of 15 days from the date of this
                            communication.</strong> After the completion of this period, you may request a re-evaluation
                        once you have adequately prepared and are confident in your understanding of the subject matter.
                    </p>

                    <p>We wish you the best in your preparation and look forward to your improved performance in the
                        next evaluation.</p>
                @endif

                <p>For any concerns, or if you would like to discuss the evaluation in detail, you may connect with us
                    via <strong>Microsoft Teams</strong> or <strong>WhatsApp</strong>.</p>

                <!-- Submission Details -->
                <div class="details-box">
                    <div class="details-title">Submission Details</div>
                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $submission->email ?? 'N/A' }}</span>
                    </div>

                    @if (isset($submission) && $submission->description)
                        <div class="detail-row" style="margin-top: 15px;">
                            <span class="detail-label">Description</span>
                            <div class="detail-value" style="font-weight: normal; margin-top: 5px;">
                                {!! $submission->description !!}
                            </div>
                        </div>
                    @endif

                    @if (isset($submission) && !empty($submission->issues))
                        <div class="detail-row" style="margin-top: 15px;">
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

                    @if (isset($submission) && !empty($submission->images))
                        <div class="detail-row" style="margin-top: 15px;">
                            <span class="detail-label">Attachments</span>
                            <div class="detail-value" style="margin-top: 5px;">
                                @foreach ($submission->images as $index => $imagePath)
                                    <span class="image-tag">&#128206; Image {{ $index + 1 }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Score & Status Section -->
                <div class="score-container">
                    <div class="score-box">
                        <span class="score-label">Marks Obtained</span>
                        <div class="score-value">{{ $submission->marks_obtained ?? 0 }} <span
                                style="font-size:16px; color:#9ca3af;">/ {{ $submission->max_marks ?? 100 }}</span>
                        </div>
                    </div>
                    <div>
                        <span
                            class="badge {{ isset($status) && $status === 'Pass' ? 'badge-pass' : 'badge-fail' }}">{{ $status ?? 'Fail' }}</span>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div>Best regards,</div>
                <div class="signature">Excelsior Technologies</div>

                <div class="contact-info">
                    &copy; {{ date('Y') }} Excelsior Technologies. All rights reserved.<br>
                    This is an automated message, please do not reply.
                </div>
            </div>
        </div>
    </div>
</body>

</html>
