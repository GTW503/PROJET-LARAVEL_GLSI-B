<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Universities Display Section -->
                    @if($universities && $universities->count() > 0)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900">Universities</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($universities as $university)
                                    <div class="bg-white shadow-lg rounded-lg p-4 hover:scale-105 transform transition duration-500 ease-in-out">
                                        <h3 class="font-bold text-orange-500">{{ $university->name }}</h3>
                                        <p>{{ $university->description }}</p>
                                        <!-- Rating Section -->
                                        <div class="my-2 rating" data-id="{{ $university->id }}">
                                            @php $rating = $university->ratings->avg('score') ?? 0; @endphp
                                            @foreach(range(1, 5) as $i)
                                                <i class="{{ $i <= round($rating) ? 'fas' : 'far' }} fa-star text-yellow-400"></i>
                                            @endforeach
                                            <span class="text-sm text-gray-600">({{ number_format($rating, 1) }} stars)</span>
                                        </div>
                                        <!-- Photos Section -->
                                        <div class="flex flex-wrap justify-center">
                                            @foreach($university->photos as $photo)
                                                <img src="{{ Storage::url($photo->path) }}" alt="Photo of {{ $university->name }}" class="object-cover mr-2 mb-2 rounded-lg shadow cursor-pointer hover:shadow-lg transition-shadow duration-300" style="height: 240px; width: 100%;">
                                            @endforeach
                                        </div>
                                        <!-- Action Links -->
                                        <div class="flex justify-between mt-4">
                                            <a href="{{ route('universities.details', $university) }}" class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-eye"></i> Details
                                            </a>
                                            <a href="{{ route('universities.comments', $university) }}" class="text-green-500 hover:text-green-700">
                                                <i class="fas fa-comments"></i> All Comments
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p>No universities to display.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Comment Modal -->
    <div id="commentModal" class="modal hidden">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="{{ route('comments.store', ['university' => $university->id ?? 0]) }}" method="POST">
                @csrf
                <input type="hidden" name="university_id" id="universityId" value="">
                <textarea name="content" placeholder="Add a comment..." required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <style>
        .rating {
            color: #ffc107;
            cursor: pointer;
        }
        .rating i:hover,
        .rating i:hover ~ i {
            color: #ffc107;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }
    </style>

    <script>
        // Functions to handle the comment modal
        function openCommentModal(universityId) {
            document.getElementById('universityId').value = universityId;
            document.getElementById('commentModal').classList.remove('hidden');
        }

        function closeModal() {
            document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
        }
    </script>
</x-app-layout>
