<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Application Status -->
                    <div class="mb-6">
                        <x-status-badge :status="$application->status" class="px-3 py-1 text-sm">
                            Status: {{ ucfirst($application->status) }}
                        </x-status-badge>
                    </div>

                    <!-- Opportunity Details -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Opportunity Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Title</p>
                                <p class="text-sm text-gray-900">{{ $application->opportunity->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Department</p>
                                <p class="text-sm text-gray-900">{{ $application->opportunity->department->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Compensation</p>
                                <p class="text-sm text-gray-900">{{ $application->opportunity->formatted_amount }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Expiry Date</p>
                                <p class="text-sm text-gray-900">{{ $application->opportunity->expiry_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Details -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Applicant Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="text-sm text-gray-900">{{ $application->applicant->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-sm text-gray-900">{{ $application->applicant->email_address }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-sm text-gray-900">{{ $application->applicant->phone_number ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cohort</p>
                                <p class="text-sm text-gray-900">{{ $application->applicant->cohort ?? 'Not specified' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cover Letter -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Cover Letter</h3>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $application->cover_letter }}</p>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    @if($application->additional_notes)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Additional Notes</h3>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $application->additional_notes }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Documents -->
                    @if($application->documents->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Supporting Documents</h3>
                            <div class="space-y-2">
                                @foreach($application->documents as $document)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $document->file_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $document->document_type }} • {{ number_format($document->file_size / 1024, 1) }} KB</p>
                                        </div>
                                        <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                            View
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Resume -->
                    @if($application->resume_path)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Resume/CV</h3>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Resume</p>
                                    <p class="text-xs text-gray-500">PDF/DOC file</p>
                                </div>
                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                    View Resume
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Review Information -->
                    @if($application->reviewed_at)
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Review Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Reviewed By</p>
                                    <p class="text-sm text-gray-900">{{ $application->reviewer->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Reviewed On</p>
                                    <p class="text-sm text-gray-900">{{ $application->reviewed_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <a href="{{ route('applications.index') }}" class="text-indigo-600 hover:text-indigo-900">
                                ← Back to Applications
                            </a>
                        </div>
                        <div class="flex space-x-3">
                            @if(auth()->user()->isApplicant() && $application->applicant_id === auth()->id())
                                @if($application->status === 'pending')
                                    <a href="{{ route('applications.edit', $application) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit Application
                                    </a>
                                    <form method="POST" action="{{ route('applications.withdraw', $application) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to withdraw this application?')">
                                            Withdraw
                                        </button>
                                    </form>
                                @endif
                            @endif

                            @if((auth()->user()->isAdmin() || auth()->user()->isHrOfficer()) && $application->status === 'pending')
                                <button onclick="document.getElementById('reviewModal').classList.remove('hidden')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Review Application
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    @if((auth()->user()->isAdmin() || auth()->user()->isHrOfficer()) && $application->status === 'pending')
        <div id="reviewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Review Application</h3>
                    <form method="POST" action="{{ route('applications.review', $application) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Status</option>
                                <option value="shortlisted">Shortlisted</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Feedback (Optional)</label>
                            <textarea name="feedback" rows="3" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="document.getElementById('reviewModal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-app-layout> 