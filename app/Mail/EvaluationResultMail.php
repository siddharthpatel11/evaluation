<?php

namespace App\Mail;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EvaluationResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public Submission $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function envelope(): Envelope
    {
        $name = $this->submission->name ?? 'Candidate';
        $monthYear = now()->format('F Y');
        
        $subject = "Internship Evaluation Process and Next Steps | {$name} | {$monthYear}";

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        $scoreRatio = $this->submission->max_marks > 0
            ? ($this->submission->marks_obtained / $this->submission->max_marks) * 10
            : 0;

        $status = $scoreRatio >= 5 ? 'Pass' : 'Fail';

        return new Content(
            view: 'emails.evaluation.result',
            with: [
                'status' => $status,
            ]
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if (! empty($this->submission->images) && is_array($this->submission->images)) {
            foreach ($this->submission->images as $index => $imagePath) {
                $fullPath = storage_path('app/public/'.$imagePath);

                if (file_exists($fullPath)) {
                    // Detect proper MIME type so email clients can open the image
                    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                    $mimeMap = [
                        'jpg' => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                        'webp' => 'image/webp',
                    ];
                    $mime = $mimeMap[$extension] ?? 'image/jpeg';
                    $filename = 'image_'.($index + 1).'.'.$extension;

                    $attachments[] = Attachment::fromPath($fullPath)
                        ->as($filename)
                        ->withMime($mime);
                }
            }
        }

        return $attachments;
    }
}
