<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEnquiryStatusRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    /**
     * Display customer enquiries with simple dashboard filters.
     */
    public function index(Request $request): View
    {
        $enquiries = Enquiry::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('subject'), fn ($query) => $query->where('subject', $request->string('subject')->toString()))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('created_at', $request->date('date')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $enquiryStats = [
            'total' => Enquiry::count(),
            'new' => Enquiry::query()->where('status', 'new')->count(),
            'responded' => Enquiry::query()->where('status', 'responded')->count(),
            'pending' => Enquiry::query()->where('status', 'pending')->count(),
        ];
        $subjects = Enquiry::query()->select('subject')->distinct()->orderBy('subject')->pluck('subject');

        return view('enquries.index', compact('enquiries', 'enquiryStats', 'subjects'));
    }

    /**
     * Save the current handling status for one customer enquiry.
     */
    public function update(UpdateEnquiryStatusRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update($request->validated());

        return back()->with('success', 'Enquiry status updated successfully.');
    }
}
