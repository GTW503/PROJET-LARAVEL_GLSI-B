<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4 text-orange-500">{{ $university->name }}</h2>
                    <p class="mb-4 text-gray-700">{{ $university->description }}</p> 
                    <p class="mb-4 text-purple-500">{{ $university->location }}</p>

                    <!-- Photo Gallery -->
                    <div class="relative mb-4 rounded-lg overflow-hidden shadow-lg" style="height: 250px;">
                        @foreach($university->photos as $photo)
                            <img src="{{ Storage::url($photo->path) }}" alt="Photo of {{ $university->name }}" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                        @endforeach
                    </div>

                    <!-- Rating Section -->
                    <div class="rating mb-4" data-id="{{ $university->id }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="rating-star fa fa-star{{ $i <= round($rating) ? '' : '-o' }} text-yellow-400 cursor-pointer" data-rate="{{ $i }}"></i>
                        @endfor
                        <span class="text-sm text-gray-600">({{ number_format($rating, 1) }} stars)</span>
                    </div>

                    <h3 class="text-lg font-semibold mb-2">Add a Comment and Rate</h3>
                    <form id="commentForm" action="{{ route('comments.store', $university) }}" method="POST">
                        @csrf
                        <textarea name="content" class="w-full h-16 border-gray-300 focus:ring-orange-500 focus:border-orange-500 mt-1 p-2 shadow-sm rounded-md" placeholder="Add a comment..." required></textarea>
                        <input type="number" name="rating" id="ratingValue" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Rate (1-5)" min="1" max="5" required>
                        <div class="flex justify-between items-center mt-4">
                            <button type="button" onclick="history.back()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                <i class="fas fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Photo gallery transition
        let images = document.querySelectorAll('.relative img');
        let currentIndex = 0;
        images[currentIndex].style.opacity = 1; // Initialize first image as visible

        function showNextImage() {
            images[currentIndex].style.opacity = 0;
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].style.opacity = 1;
        }
        setInterval(showNextImage, 4900);

        // Rating system functionality
        document.querySelectorAll('.rating-star').forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rate);
                document.getElementById('ratingValue').value = rating;
                updateStars(rating);
            });
        });

        function updateStars(rating) {
            const stars = document.querySelectorAll('.rating-star');
            stars.forEach((star, index) => {
                star.classList.toggle('fa-star', index < rating);
                star.classList.toggle('fa-star-o', index >= rating);
            });
        }
    </script>
</x-app-layout>
