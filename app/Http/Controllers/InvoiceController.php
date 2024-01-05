<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Notifications\InvoiceCreated;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::myInvoices();
        
        return InvoiceResource::collection($invoices->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();

        $invoice = Invoice::create($validated);

        return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $validated = $request->validated();
        $invoice->update($validated);
    
        return new InvoiceResource($invoice->refresh()->load(['created_by_user']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        $invoice->delete();
        
        return response()->noContent();
    }
}
