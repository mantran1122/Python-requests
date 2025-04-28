<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LlmConfiguration;


class LlmConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configs = LlmConfiguration::all(); // <- Cái này là MUST
        return view('admin.llm_configurations.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.llm_configurations.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'api_key' => 'required|string',
            'model' => 'nullable|string|max:255',
            'provider' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
        ]);

        LlmConfiguration::create([
            'name' => $request->name,
            'api_key' => $request->api_key,
            'model' => $request->model,
            'provider' => $request->provider,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.llm-configurations.index')
            ->with('success', 'LLM Configuration created successfully.');
    }

    // Update
    public function update(Request $request, LlmConfiguration $llmConfiguration)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'api_key' => 'required|string',
            'model' => 'nullable|string|max:255',
            'provider' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
        ]);

        $llmConfiguration->update([
            'name' => $request->name,
            'api_key' => $request->api_key,
            'model' => $request->model,
            'provider' => $request->provider,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.llm-configurations.index')
            ->with('success', 'LLM Configuration updated successfully.');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }

    public function toggleActive(Request $request, LlmConfiguration $llmConfiguration)
    {
        $llmConfiguration->active = !$llmConfiguration->active;
        $llmConfiguration->save();

        return response()->json([
            'success' => true,
            'active' => $llmConfiguration->active,
        ]);
    }

}
