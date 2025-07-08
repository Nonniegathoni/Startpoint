@extends('layouts.app')

@section('title', 'Create Opportunity - StartPoint')
@section('page-title', 'Create Opportunity')
@section('page-description', 'Fill in the details to create a new opportunity for students and cohorts')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-blue-600"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">New Opportunity</h2>
                    <p class="text-gray-600">Create a new opportunity for students and cohorts</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('opportunities.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-600"></i>
                    Basic Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Opportunity Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               required
                               placeholder="e.g., Software Developer Internship"
                               class="form-input {{ $errors->has('title') ? 'error' : '' }}">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <select id="department" name="department" required class="form-input {{ $errors->has('department') ? 'error' : '' }}">
                            <option value="">Select Department</option>
                            @if(isset($departments))
                                @foreach($departments as $value => $label)
                                    <option value="{{ $value }}" {{ old('department') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('department')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Opportunity Details -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-briefcase text-green-600"></i>
                    Opportunity Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="opportunity_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Opportunity Type <span class="text-red-500">*</span>
                        </label>
                        <select id="opportunity_type" name="opportunity_type" required class="form-input {{ $errors->has('opportunity_type') ? 'error' : '' }}">
                            <option value="">Select Type</option>
                            @if(isset($opportunityTypes))
                                @foreach($opportunityTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('opportunity_type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('opportunity_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Application Deadline <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="expiry_date" 
                               name="expiry_date" 
                               value="{{ old('expiry_date') }}" 
                               required
                               min="{{ date('Y-m-d') }}"
                               class="form-input {{ $errors->has('expiry_date') ? 'error' : '' }}">
                        @error('expiry_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="opportunity_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="opportunity_description" 
                              name="opportunity_description" 
                              rows="4" 
                              required
                              placeholder="Describe the opportunity, requirements, and what students can expect..."
                              class="form-input {{ $errors->has('opportunity_description') ? 'error' : '' }}">{{ old('opportunity_description') }}</textarea>
                    @error('opportunity_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Compensation Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-money-bill-wave text-yellow-600"></i>
                    Compensation Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="compensation_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Compensation Type <span class="text-red-500">*</span>
                        </label>
                        <select id="compensation_type" name="compensation_type" required class="form-input {{ $errors->has('compensation_type') ? 'error' : '' }}">
                            <option value="">Select Compensation</option>
                            @if(isset($compensationTypes))
                                @foreach($compensationTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('compensation_type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('compensation_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="compensation_amount" class="block text-sm font-medium text-gray-700 mb-2">
                            Amount (KES)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm font-medium">KES</span>
                            </div>
                            <input type="number" 
                                   id="compensation_amount" 
                                   name="compensation_amount" 
                                   value="{{ old('compensation_amount') }}" 
                                   min="0" 
                                   step="1"
                                   placeholder="0"
                                   class="form-input pl-14 {{ $errors->has('compensation_amount') ? 'error' : '' }}">
                        </div>
                        @error('compensation_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Leave blank if compensation is not monetary</p>
                    </div>
                </div>
                
                <!-- Hidden field for currency -->
                <input type="hidden" name="compensation_currency" value="KES">
            </div>

            <!-- Requirements -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-list-check text-purple-600"></i>
                    Requirements & Skills
                </h3>
                
                <div>
                    <label for="core_competencies" class="block text-sm font-medium text-gray-700 mb-2">
                        Core Competencies & Requirements
                    </label>
                    <textarea id="core_competencies" 
                              name="core_competencies" 
                              rows="3"
                              placeholder="List the key skills, qualifications, and competencies required for this opportunity..."
                              class="form-input {{ $errors->has('core_competencies') ? 'error' : '' }}">{{ old('core_competencies') }}</textarea>
                    @error('core_competencies')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Include technical skills, soft skills, education level, etc.</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('opportunities.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Opportunities
                </a>
                
                <div class="flex items-center gap-4">
                    <button type="reset" class="btn-secondary">
                        <i class="fas fa-undo"></i>
                        Reset Form
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        Create Opportunity
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Show/hide compensation amount based on compensation type
document.getElementById('compensation_type').addEventListener('change', function() {
    const amountField = document.getElementById('compensation_amount').parentElement.parentElement;
    const selectedValue = this.value;
    
    if (selectedValue === 'Unpaid' || selectedValue === 'Volunteer') {
        amountField.style.opacity = '0.5';
        document.getElementById('compensation_amount').disabled = true;
        document.getElementById('compensation_amount').value = '';
    } else {
        amountField.style.opacity = '1';
        document.getElementById('compensation_amount').disabled = false;
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const compensationType = document.getElementById('compensation_type');
    if (compensationType.value) {
        compensationType.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
