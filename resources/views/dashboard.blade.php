<x-app-layout>

    <div class="overflow-hidden bg-white py-6 sm:py-6">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div id="welcome-carousel" class="relative" data-carousel="static">
                <!-- Slide 1 -->
                <div class="block duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-semibold leading-7 text-indigo-600">Welcome to</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tel-U Coffee</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">Welcome to Tel-U Coffee, where the art of coffee meets the power of flavor. We invite you to embark on a journey through our world of coffee, where each bean is carefully selected to craft an unforgettable coffee experience. Discover the exceptional taste that awaits you—indulge in the finest brews and elevate your coffee moments like never before!</p>
                                <a href="{{ __('menu') }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Order Now!</a>
                            </div>
                        </div>
                        <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Product Dashboard" class="w-[55rem] h-[35rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[70rem] md:-ml-4 lg:-ml-0" width="550" height="350">
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-semibold leading-7 text-indigo-600">Discover</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our Coffee Journey</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">Experience the passion behind every cup of coffee at Tel-U Coffee. From the farm to your cup, we ensure every step brings out the best flavors for you to enjoy. Explore our unique blends and immerse yourself in the world of exceptional coffee.</p>
                                <a href="https://telkomuniversity.ac.id/tel-u-coffee-diresmikan-secangkir-kopi-untuk-endownment-fund/}}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Learn More</a>
                            </div>
                        </div>
                        <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Coffee Process" class="w-[55rem] h-[35rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[70rem] md:-ml-4 lg:-ml-0" width="550" height="350">
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-semibold leading-7 text-indigo-600">Taste</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Excellence in Every Sip</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">Indulge in the premium flavors of Tel-U Coffee. Our commitment to quality ensures every cup is a celebration of taste and aroma. Join us in redefining your coffee experience with our expertly crafted blends.</p>
                                <a href="{{ __('menu') }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Shop Now</a>
                            </div>
                        </div>
                        <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Premium Coffee" class="w-[55rem] h-[35rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[70rem] md:-ml-4 lg:-ml-0" width="550" height="350">
                    </div>
                </div>
                <!-- Carousel Indicators -->
                <div id="welcome-carousel" class="relative w-full">
                    <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3">
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="true" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="false" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="false" data-carousel-slide-to="2"></button>
                    </div>
                    <!-- Slider Items -->
                    <div class="carousel-item" data-carousel-item>Slide 1</div>
                    <div class="carousel-item hidden" data-carousel-item>Slide 2</div>
                    <div class="carousel-item hidden" data-carousel-item>Slide 3</div>

                    <!-- Button with '-' or '+' below carousel -->
                    <div class="absolute bottom-2 z-20 flex justify-center -translate-x-1/2 space-x-3">
                        <button id="prev" class="text-xl text-gray-500">←</button>
                        <button id="next" class="text-xl text-gray-500">→</button>
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
                                indicator.classList.add("bg-yellow-500");
                                indicator.setAttribute("aria-current", "true");
                            } else {
                                indicator.classList.remove("bg-yellow-500");
                                indicator.setAttribute("aria-current", "false");
                            }
                        });

                        // Change button colors based on current slide
                        const buttons = [prevButton, nextButton];
                        buttons.forEach((button, idx) => {
                            if (idx === index) {
                                button.classList.add("text-yellow-500");
                            } else {
                                button.classList.remove("text-yellow-500");
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
                    setInterval(nextSlide, 5000);

                    // Handle indicator click
                    indicators.forEach((indicator, index) => {
                        indicator.addEventListener("click", () => {
                            currentIndex = index;
                            showSlide(currentIndex);
                        });
                    });

                    // Handle prev and next button click
                    prevButton.addEventListener("click", prevSlide);
                    nextButton.addEventListener("click", nextSlide);
                });
                </script>


            </div>
        </div>
    </div>

    <!-- Add Margin or Padding to Prevent Overlap with Header -->
    <div class="mt-16"> <!-- Adjust the margin-top to make space under the header -->
        <section>
            <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-20 max-w-7xl mt-10">
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-10">What Are They Saying About Tel-U Coffee?</p>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="inline-block p-4 mx-auto text-left align-bottom transition-all transform bg-gray-100 sm:align-middle sm:p-8 rounded-2xl">
                        <div class="flex w-full mb-4">
                            <div class="flex-grow pl-3">
                                <h6 class="text-lg font-medium leading-6 text-black">Kaisa</h6>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <p class="text-base text-gray-500">
                                "Saya baru-baru ini mencoba kopi dari Tel-U Coffee, dan saya benar-benar terkesan! Aroma kopi mereka begitu kuat dan menggoda, memberikan pengalaman yang luar biasa sejak pertama kali menciumnya. Tel-U Coffee benar-benar membawa kopi ke tingkat yang baru!"
                            </p>
                        </div>
                    </div>
                    <div class="inline-block p-4 mx-auto text-left align-bottom transition-all transform bg-gray-100 sm:align-middle sm:p-8 rounded-2xl">
                        <div class="flex w-full mb-4">
                            <div class="flex-grow pl-3">
                                <h6 class="text-lg font-medium leading-6 text-black">Putri</h6>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <p class="text-base text-gray-500">
                                "Saya seorang pencinta kopi sejati, dan Tel-U Coffee memberikan segalanya yang saya cari dalam secangkir kopi. Pilihan mereka yang beragam membuat saya bisa mencoba berbagai rasa dan asal biji kopi. Saya sangat menghargai ketelitian mereka dalam pemilihan biji, dan hasil akhirnya terasa begitu sempurna."
                            </p>
                        </div>
                    </div>
                    <div class="inline-block p-4 mx-auto text-left align-bottom transition-all transform bg-gray-100 sm:align-middle sm:p-8 rounded-2xl">
                        <div class="flex w-full mb-4">
                            <div class="flex-grow pl-3">
                                <h6 class="text-lg font-medium leading-6 text-black">Aqila</h6>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <p class="text-base text-gray-500">
                                "Saya suka sekali dengan pengalaman belanja di Tel-U Coffee. Website mereka mudah dinavigasi, dan koleksi kopi yang ditawarkan sangat mengesankan. Saya memesan campuran kopi untuk mencoba variasi rasa, dan saya tidak kecewa."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section>
        <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-20 max-w-7xl">
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">About Tel-U Coffee!</p>
            <div class="grid grid-cols-1 gap-6 py-12">
                <figure class="col-span-1">
                    <iframe class="w-full h-96 bg-gray-200" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.9332736838775!2d107.62938131600799!3d-6.9730998494847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e92e2dbda471%3A0x9db28a376f2dd64!2sTel-U%20Coffee!5e0!3m2!1sen!2sid!4v1690123456789!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </figure>
                <div class="text-lg text-gray-600">
                    <p><strong>Located in:</strong> Telkom University</p>
                    <p><strong>Address:</strong> Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257</p>
                    <p><strong>Hours:</strong> Closed ⋅ Opens 7.00 am</p>
                    <p><strong>Phone:</strong> 0813-2322-1710</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
