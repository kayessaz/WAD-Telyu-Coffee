<x-app-layout>
    <div class="overflow-hidden bg-white py-6 sm:py-6">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div id="welcome-carousel" class="relative" data-carousel="static">
                <!-- Slide 1 -->
                <div class="block duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-semibold leading-7 text-indigo-600 text-red-700">Welcome to</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tel-U Coffee</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">Welcome to Tel-U Coffee, where the art of coffee meets the power of flavor. We invite you to embark on a journey through our world of coffee, where each bean is carefully selected to craft an unforgettable coffee experience. Discover the exceptional taste that awaits you—indulge in the finest brews and elevate your coffee moments like never before!</p>
                                <a href="{{ __('menu') }}" class="bg-red-600 hover:bg-red-700 text-gray-200 font-semibold py-2 px-4 border border-red-700 rounded shadow">Order Now!</a>
                            </div>
                        </div>
                        <img src="{{ asset('photos/dashboard1.png') }}" alt="Dashboard-3" class="w-[550px] h-[550px] rounded-xl shadow-xl ring-1 ring-gray-400/10 object-cover">
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-16 sm:gap-y-20">
                        <!-- Image Section -->
                        <div class="flex lg:justify-start">
                            <img src="{{ asset('photos/dashboard2.png') }}" alt="Dashboard-3"
                                 class="w-[550px] h-[550px] rounded-xl shadow-xl ring-1 ring-gray-400/10 object-cover">
                        </div>
                        <!-- Text Section -->
                        <div class="lg:max-w-lg">
                            <h2 class="text-base font-semibold leading-7 text-indigo-600 text-red-700">Discover</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our Coffee Journey</p>
                            <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">
                                Experience the passion behind every cup of coffee at Tel-U Coffee. From the farm to your cup, we ensure every step brings out the best flavors for you to enjoy. Explore our unique blends and immerse yourself in the world of exceptional coffee.</p>
                            <a href="https://telkomuniversity.ac.id/tel-u-coffee-diresmikan-secangkir-kopi-untuk-endownment-fund/"
                               class="bg-red-600 hover:bg-red-700 text-gray-200 font-semibold py-2 px-4 border border-red-700 rounded shadow">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-semibold leading-7 text-indigo-600 text-red-700">Taste</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Excellence in Every Sip</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">Indulge in the premium flavors of Tel-U Coffee. Our commitment to quality ensures every cup is a celebration of taste and aroma. Join us in redefining your coffee experience with our expertly crafted blends.</p>
                                <a href="{{ __('menu') }}" class="bg-red-600 hover:bg-red-700 text-gray-200 font-semibold py-2 px-4 border border-red-700 rounded shadow">Shop Now</a>
                            </div>
                        </div>
                        <img src="{{ asset('photos/dashboard3.png') }}" alt="Dashboard-3" class="w-[550px] h-[550px] rounded-xl shadow-xl ring-1 ring-gray-400/10 object-cover">
                    </div>
                </div>

                <!-- Carousel Indicators -->
                <div id="welcome-carousel" class="relative w-full">
                    <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3">
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="true" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="false" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="false" data-carousel-slide-to="2"></button>
                    </div>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const carousel = document.querySelector("#welcome-carousel");
                    const items = carousel.querySelectorAll("[data-carousel-item]");
                    const indicators = carousel.querySelectorAll("[data-carousel-slide-to]");
                    const prevButton = document.querySelector("#prev");
                    const nextButton = document.querySelector("#next");
                    let currentIndex = 0;
                    const totalSlides = items.length;

                    function showSlide(index) {
                        // Hide all slides
                        items.forEach((item, idx) => {
                            if (idx === index) {
                                item.classList.remove("hidden");
                            } else {
                                item.classList.add("hidden");
                            }
                        });

                        // Update indicators
                        indicators.forEach((indicator, idx) => {
                            if (idx === index) {
                                indicator.classList.add("bg-red-600");
                                indicator.setAttribute("aria-current", "true");
                            } else {
                                indicator.classList.remove("bg-red-600");
                                indicator.setAttribute("aria-current", "false");
                            }
                        });
                    }

                    function nextSlide() {
                        currentIndex = (currentIndex + 1) % totalSlides;
                        showSlide(currentIndex);
                    }

                    function prevSlide() {
                        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                        showSlide(currentIndex);
                    }

                    // Initial setup
                    showSlide(currentIndex);

                    // Set interval for auto slide
                    setInterval(nextSlide, 4000);

                    // Handle indicator click
                    indicators.forEach((indicator, index) => {
                        indicator.addEventListener("click", () => {
                            currentIndex = index;
                            showSlide(currentIndex);
                        });
                    });
                });
                </script>
            </div>
        </div>
    </div>

    <section id="specialtiesSection" class="opacity-0 translate-y-10 transition-all duration-700">
        <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mx-2 mt-6 mb-10">Our Specialities</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-red-700 bg-opacity-80 shadow-xl w-full max-w-xs mx-auto transition-all hover:bg-red-800 hover:scale-105 p-4 rounded-lg">
                <div>
                    <img src="{{ asset('photos/speciality-1.png') }}" alt="Speciality-1" class="mx-auto">
                    <p class="text-xl font-bold tracking-tight text-white sm:text-xl text-center mx-2 mt-2 mb-1">Endowment Fund</p>
                    <p class="text-center mx-2 text-gray-200 mr-2 ml-2 mb-2">Every cup of coffee sold will allocate a portion of the proceeds to the Endowment Fund.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-red-700 bg-opacity-80 shadow-xl w-full max-w-xs mx-auto transition-all hover:bg-red-800 hover:scale-105 p-4 rounded-lg">
                <div>
                    <img src="{{ asset('photos/speciality-2.png') }}" alt="Speciality-2" class="mx-auto">
                    <p class="text-xl font-bold tracking-tight text-white sm:text-xl text-center mx-2 mt-2 mb-1">Study Space</p>
                    <p class="text-center mx-2 text-gray-200 mr-2 ml-2 mb-2">Enjoy a comfortable and quiet atmosphere to focus on your work or assignments.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-red-700 bg-opacity-80 shadow-xl w-full max-w-xs mx-auto transition-all hover:bg-red-800 hover:scale-105 p-4 rounded-lg">
                <div>
                    <img src="{{ asset('photos/speciality-3.png') }}" alt="Speciality-3" class="mx-auto">
                    <p class="text-xl font-bold tracking-tight text-white sm:text-xl text-center mx-2 mt-2 mb-1">Tel-U Signature Blends</p>
                    <p class="text-center mx-2 text-gray-200 mr-2 ml-2 mb-2">Exclusive blends of various coffee beans, tailored to customer preferences for a unique coffee experience.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-red-700 bg-opacity-80 shadow-xl w-full max-w-xs mx-auto transition-all hover:bg-red-800 hover:scale-105 p-4 rounded-lg">
                <div>
                    <img src="{{ asset('photos/speciality-4.png') }}" alt="Speciality-4" class="mx-auto">
                    <p class="text-xl font-bold tracking-tight text-white sm:text-xl text-center mx-2 mt-2 mb-1">Coffee & Culture Hub</p>
                    <p class="text-center mx-2 text-gray-200 mr-2 ml-2 mb-2">Tel-U Coffee serves more than just coffee; it's a hub for cultural activities to gather and share inspiration.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Intersection Observer untuk animasi saat discroll
        const section = document.getElementById('specialtiesSection');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    section.classList.add('opacity-100', 'translate-y-0');
                    section.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, { threshold: 0.2 });

        observer.observe(section);
    </script>

    <section class="best-menu py-16">
        <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mx-2 mb-10">Our Best Menu</p>
        <div class="max-w-7xl mx-auto">
            <!-- Best Coffee (Hot Latte) -->
            <div class="flex items-center mb-16">
                <img src="{{ asset('photos/hot-latte.png') }}" alt="Best Menu-1" class="w-[650px] h-[650px] rounded-xl shadow-xl object-cover">
                <div class="absolute left-1/4">
                    <div class="bg-red-700 bg-opacity-70 text-white rounded-lg p-6 max-w-lg w-[500px] sm:w-[650px] mx-auto ml-8 hover:bg-red-700 hover:text-white hover:scale-105 transition duration-300">
                        <h3 class="text-2xl font-bold mb-4">Hot Latte</h3>
                        <p class="text-lg">A smooth and creamy coffee drink made with a shot of espresso and steamed milk, topped with a light layer of froth.</p>
                    </div>
                </div>
            </div>

            <!-- Iced Latte (Es Kopi Endowment) -->
            <div class="flex items-center mb-16">
                <div class="absolute right-1/4 bg-red-700 bg-opacity-70 text-white rounded-lg p-6 max-w-lg w-[650px] sm:w-[650px] mx-auto sm:mr-8 sm:mt-0 mt-6 hover:bg-red-700 hover:text-white hover:scale-105 transition duration-300">
                    <h3 class="text-2xl font-bold mb-4 text-right">Es Kopi Endowment</h3>
                    <p class="text-lg text-right">Made with a perfect combination of strong brewed national coffee, sweetened condensed milk, and palm sugar (gula aren).</p>
                </div>
                <img src="{{ asset('photos/endowment.png') }}" alt="Best Menu-2" class="w-full sm:w-[650px] h-[650px] rounded-xl shadow-xl object-cover">
            </div>
        </div>

        <!-- View All Menu Button -->
        <div class="text-center mt-10">
            <a href="{{ __('menu') }}"
            class="inline-flex justify-center gap-2 px-6 py-3 text-red-700 font-semibold rounded-full border-2 border-red-700 bg-white hover:bg-red-700 hover:text-white hover:scale-105 transition duration-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                </svg>
                View All Menu
            </a>
        </div>

    </section>


    <div class="relative">
        <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mt-10 mb-10">The Atmosphere</p>
        <!-- Gallery Images -->
        <div class="flex items-center">
            <!-- Images Container -->
            <div id="gallery" class="flex space-x-4 overflow-hidden transition-transform duration-500 ease-in-out">
                <img src="{{ asset('photos/ambience-1.png') }}" alt="Image 1" class="w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg">
                <img src="{{ asset('photos/ambience-2.png') }}" alt="Image 2" class="w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg">
                <img src="{{ asset('photos/ambience-3.png') }}" alt="Image 3" class="w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg">
                <img src="{{ asset('photos/ambience-4.png') }}" alt="Image 4" class="w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg">
            </div>
            <!-- Previous Button -->
            <button id="prevButton" class="absolute mt-7 left-2 top-1/2 transform -translate-y-1/2 bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-2 rounded-full"> &lt; </button>
            <!-- Next Button -->
            <button id="nextButton" class="absolute mt-7 right-2 top-1/2 transform -translate-y-1/2 bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-2 rounded-full"> &gt; </button>
        </div>
    </div>

    <script>
        const images = [
            [
                "{{ asset('photos/ambience-1.png') }}",
                "{{ asset('photos/ambience-2.png') }}",
                "{{ asset('photos/ambience-3.png') }}",
                "{{ asset('photos/ambience-4.png') }}"
            ],
            [
                "{{ asset('photos/ambience-5.png') }}",
                "{{ asset('photos/ambience-6.png') }}",
                "{{ asset('photos/ambience-7.png') }}",
                "{{ asset('photos/ambience-8.png') }}"
            ]
        ];

        let currentIndex = 0;

        document.getElementById('nextButton').addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % images.length; // Cycle through the image sets
            updateGallery();
        });

        document.getElementById('prevButton').addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Cycle backwards through the image sets
            updateGallery();
        });

        function updateGallery() {
            const gallery = document.getElementById('gallery');
            gallery.innerHTML = ''; // Clear current images

            // Add new images to the gallery
            images[currentIndex].forEach(src => {
                const img = document.createElement('img');
                img.src = src;
                img.alt = 'Gallery Image';
                img.className = 'w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg';
                gallery.appendChild(img);
            });
        }
    </script>

    <section class>
        <p class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mt-20 mb-0">Location and Operational Hours</p>
        <div class="grid grid-cols-1 gap-6 py-12">
            <figure class="col-span-1">
                <iframe class="w-full h-96 bg-gray-200" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.9332736838775!2d107.62938131600799!3d-6.9730998494847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e92e2dbda471%3A0x9db28a376f2dd64!2sTel-U%20Coffee!5e0!3m2!1sen!2sid!4v1690123456789!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </figure>
            <div class="text-lg text-gray-600">
                <p><strong>Located in:</strong> Telkom University</p>
                <p><strong>Address:</strong> Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257</p>
                <p><strong>Hours:</strong> Monday - Saturday ⋅ 7.00 am - 10.00 pm</p>
                <p><strong>Phone:</strong> 0813-2322-1710</p>
            </div>
        </div>
    </section>

</x-app-layout>
