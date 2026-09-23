<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the customer contact page.
     */
    public function index(): View
    {
        return view('frontend.contact');
    }

    /**
     * Save a customer message for the dashboard team.
     */
    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        Enquiry::create($request->safe()->only([
            'name',
            'email',
            'phone',
            'subject',
            'message',
        ]));

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been sent. We will get back to you soon.');
    }
}
