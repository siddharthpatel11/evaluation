<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Mail\EvaluationResultMail;
use App\Models\Language;
use App\Models\Submission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('name')->get();

        return view('form', compact('languages'));
    }

    public function store(SubmissionRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();

            Log::info('Starting new evaluation submission processing.');

            // Handle languages - save new ones
            $submittedLanguages = $validated['languages'];
            $finalLanguages = [];

            foreach ($submittedLanguages as $langName) {
                $langName = trim($langName);
                if (empty($langName)) {
                    continue;
                }

                // Check if language exists, if not create it
                $language = Language::firstOrCreate(['name' => $langName]);
                Log::info('Language processed: '.$language->name);

                $finalLanguages[] = $language->name;
            }

            $validated['languages'] = $finalLanguages; // Store as JSON array

            // Process Issues
            if (isset($validated['issues'])) {
                $validated['issues'] = array_values(array_filter(array_map('trim', $validated['issues'])));
            }

            // Process Images
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('submissions', 'public');
                    $imagePaths[] = $path;
                }
            }
            $validated['images'] = $imagePaths;

            $submission = Submission::create($validated);
            Log::info('Submission created successfully for: '.$submission->email);

            DB::commit();
            Log::info('Database transaction committed');

            // Send Email
            try {
                Log::info('Attempting to send evaluation result email to: '.$submission->email);

                Mail::to($submission->email)
                    ->bcc('siddharthchayani@gmail.com')
                    ->send(new EvaluationResultMail($submission));

                Log::info('Evaluation result email sent successfully!');

                return redirect()->back()->with('success', 'Form submitted successfully! Customer has been notified via email.');
            } catch (Exception $e) {
                Log::error('Failed to send notification email: '.$e->getMessage());
                Log::error('Email error trace: '.$e->getTraceAsString());

                return redirect()->back()->with('warning', 'Form submitted successfully, but failed to send email notification: '.$e->getMessage());
            }

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to process submission: '.$e->getMessage());
            Log::error('Submission error trace: '.$e->getTraceAsString());

            return redirect()->back()->with('error', 'Failed to submit form: '.$e->getMessage());
        }
    }
}
