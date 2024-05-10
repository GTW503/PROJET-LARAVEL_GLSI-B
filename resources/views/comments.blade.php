{{-- resources/views/comments.blade.php --}}
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Comments</h1>
            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded shadow transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        @forelse($comments as $comment)
            <div class="bg-white p-5 rounded-lg shadow mb-5">
                <div class="flex items-center mb-3">
                    <i class="fas fa-user-circle text-gray-700 mr-3 text-xl"></i>
                    <h5 class="font-bold text-lg">{{ $comment->user->name }}</h5>
                </div>
                <div class="mb-3">
                    <i class="fas fa-clock text-gray-500 mr-2"></i>
                    <small class="text-sm text-gray-600">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                </div>
                <p class="text-gray-800 text-md">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-gray-600">No comments to display.</p>
        @endforelse
    </div>

    <style>
        /* Additional styles can be added here */
        .container {
            max-width: 800px; /* Setting a max-width for the container */
        }
    </style>
</x-app-layout>
