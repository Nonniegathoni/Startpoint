@extends('layouts.app')

@section('content')
@php
    $header = 'Submit Application';
@endphp
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <h1 class="text-3xl font-bold text-white mb-2">Submit Your Application</h1>
        <p class="text-light-blue">
            Complete the form below to apply for this internship opportunity
        </p>
    </div>

    <!-- Application Form -->
    <div class="bg-primary/60 backdrop-blur-md rounded-2xl border border-light-blue/20 p-6 shadow-glow">
        <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Opportunity Selection -->
            <div>
                <label for="opportunity_id" class="block text-sm font-medium text-white mb-2">Select Opportunity</label>
                <select name="opportunity_id" id="opportunity_id" required 
                        class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                    <option value="">Choose an opportunity...</option>
                    @foreach(\App\Models\Opportunity::where('is_active', true)->get() as $opportunity)
                        <option value="{{ $opportunity->id }}" {{ request('opportunity') == $opportunity->id ? 'selected' : '' }}>
                            {{ $opportunity->title }} - {{ $opportunity->department->name }}
                        </option>
                    @endforeach
                </select>
                @error('opportunity_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Letter -->
            <div>
                <label for="cover_letter" class="block text-sm font-medium text-white mb-2">Cover Letter</label>
                <textarea name="cover_letter" id="cover_letter" rows="6" required
                          class="w-full bg-light-blue/10 border-light-blue/20 text-white placeholder-light-blue focus:border-accent focus:ring-accent rounded-xl"
                          placeholder="Tell us why you're interested in this opportunity and what makes you a great candidate..."></textarea>
                @error('cover_letter')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Expected Start Date -->
            <div>
                <label for="expected_start_date" class="block text-sm font-medium text-white mb-2">Expected Start Date</label>
                <input type="date" name="expected_start_date" id="expected_start_date" required
                       min="{{ date('Y-m-d') }}"
                       class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                @error('expected_start_date')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Expected End Date -->
            <div>
                <label for="expected_end_date" class="block text-sm font-medium text-white mb-2">Expected End Date</label>
                <input type="date" name="expected_end_date" id="expected_end_date" required
                       min="{{ date('Y-m-d', strtotime('+1 month')) }}"
                       class="w-full bg-light-blue/10 border-light-blue/20 text-white focus:border-accent focus:ring-accent rounded-xl">
                @error('expected_end_date')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Document Uploads -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white">Required Documents</h3>
                
                <!-- CV/Resume -->
                <div>
                    <label for="cv" class="block text-sm font-medium text-white mb-2">
                        CV/Resume <span class="text-red-400">*</span>
                    </label>
                    <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-accent file:text-white hover:file:bg-accent/80 rounded-xl">
                    <p class="mt-1 text-xs text-light-blue">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</p>
                    @error('cv')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Academic Transcript -->
                <div>
                    <label for="transcript" class="block text-sm font-medium text-white mb-2">
                        Academic Transcript <span class="text-red-400">*</span>
                    </label>
                    <input type="file" name="transcript" id="transcript" accept=".pdf,.doc,.docx" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-accent file:text-white hover:file:bg-accent/80 rounded-xl">
                    <p class="mt-1 text-xs text-light-blue">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</p>
                    @error('transcript')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Recommendation Letter -->
                <div>
                    <label for="recommendation" class="block text-sm font-medium text-white mb-2">
                        Recommendation Letter <span class="text-red-400">*</span>
                    </label>
                    <input type="file" name="recommendation" id="recommendation" accept=".pdf,.doc,.docx" required
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-accent file:text-white hover:file:bg-accent/80 rounded-xl">
                    <p class="mt-1 text-xs text-light-blue">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</p>
                    @error('recommendation')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Documents -->
                <div>
                    <label for="additional_docs" class="block text-sm font-medium text-white mb-2">
                        Additional Documents (Optional)
                    </label>
                    <input type="file" name="additional_docs[]" id="additional_docs" accept=".pdf,.doc,.docx" multiple
                           class="w-full bg-light-blue/10 border-light-blue/20 text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-medium-blue-purple file:text-white hover:file:bg-medium-blue-purple/80 rounded-xl">
                    <p class="mt-1 text-xs text-light-blue">You can upload multiple additional documents if needed</p>
                    @error('additional_docs')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-light-blue/20">
                <a href="{{ route('opportunities.index') }}" 
                   class="px-6 py-3 bg-light-blue/10 text-white font-medium rounded-xl hover:bg-light-blue/20 transition-all duration-300">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-accent to-orange-corrected text-white font-semibold rounded-xl hover:from-accent/80 hover:to-orange-corrected/80 transition-all duration-300 transform hover:scale-105 shadow-glow-orange">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Client-side validation for dates
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('expected_start_date');
        const endDateInput = document.getElementById('expected_end_date');
        
        // Set minimum start date to today
        const today = new Date().toISOString().split('T')[0];
        startDateInput.min = today;
        
        // Update end date minimum when start date changes
        startDateInput.addEventListener('change', function() {
            if (this.value) {
                const startDate = new Date(this.value);
                const minEndDate = new Date(startDate);
                minEndDate.setMonth(minEndDate.getMonth() + 1); // At least 1 month later
                endDateInput.min = minEndDate.toISOString().split('T')[0];
            }
        });
        
        // File size validation
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const files = this.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileSize = file.size / 1024 / 1024; // Convert to MB
                    if (fileSize > 5) {
                        alert(`File "${file.name}" is too large. Maximum size is 5MB.`);
                        this.value = '';
                        return;
                    }
                }
            });
        });
    });
</script>
@endsection 