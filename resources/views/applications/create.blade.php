<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apply for Internship') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Opportunity Details -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $opportunity->title }}</h3>
                        <p class="text-gray-600 mb-2">{{ $opportunity->department->name }}</p>
                        <p class="text-gray-600 mb-2">Compensation: {{ $opportunity->formatted_amount }}</p>
                        <p class="text-gray-600">Expires: {{ $opportunity->expiry_date->format('M d, Y') }}</p>
                    </div>

                    <form method="POST" action="{{ route('applications.store', $opportunity) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Cover Letter -->
                        <div class="mb-6">
                            <x-input-label for="cover_letter" :value="__('Cover Letter')" />
                            <textarea
                                id="cover_letter"
                                name="cover_letter"
                                rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Please describe why you are interested in this opportunity and what makes you a good candidate..."
                                required
                            >{{ old('cover_letter') }}</textarea>
                            <x-input-error :messages="$errors->get('cover_letter')" class="mt-2" />
                        </div>

                        <!-- Resume -->
                        <div class="mb-6">
                            <x-input-label for="resume" :value="__('Resume/CV')" />
                            <input
                                type="file"
                                id="resume"
                                name="resume"
                                accept=".pdf,.doc,.docx"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                            />
                            <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, DOC, DOCX (Max: 2MB)</p>
                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                        </div>

                        <!-- Additional Documents -->
                        <div class="mb-6">
                            <x-input-label for="documents" :value="__('Additional Documents (Optional)')" />
                            <input
                                type="file"
                                id="documents"
                                name="documents[]"
                                multiple
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            />
                            <p class="mt-1 text-sm text-gray-500">You can upload multiple documents: transcripts, certificates, etc. (Max: 2MB each)</p>
                            <x-input-error :messages="$errors->get('documents.*')" class="mt-2" />
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-6">
                            <x-input-label for="additional_notes" :value="__('Additional Notes (Optional)')" />
                            <textarea
                                id="additional_notes"
                                name="additional_notes"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Any additional information you'd like to share..."
                            >{{ old('additional_notes') }}</textarea>
                            <x-input-error :messages="$errors->get('additional_notes')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Submit Application') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 