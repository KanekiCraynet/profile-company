<x-frontend-layout>
    <x-slot name="title">Contact Us - PT Lestari Jaya Bangsa</x-slot>
    <x-slot name="metaDescription">Get in touch with PT Lestari Jaya Bangsa. Contact us for inquiries about our herbal and food products. Address, phone, and working hours provided.</x-slot>

    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-heading">Hubungi Kami</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto">
                Ada pertanyaan tentang produk atau layanan kami? Kami senang mendengar dari Anda.
            </p>
        </div>
    </section>

    <!-- Toast Notification -->
    <div id="toast-notification" 
         class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300 hidden">
        <div class="bg-green-600 text-white px-6 py-4 rounded-lg shadow-xl flex items-center space-x-3 max-w-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p id="toast-message" class="font-medium"></p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-lg p-8 reveal">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 font-heading">Kirim Pesan</h2>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <strong class="font-semibold">Berhasil!</strong>
                        </div>
                        <p class="mt-1">{{ session('success') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <strong class="font-semibold">Terjadi Kesalahan!</strong>
                        </div>
                        <ul class="list-disc list-inside mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="space-y-6" x-data="{ 
                    name: '{{ old('name') }}',
                    email: '{{ old('email') }}',
                    phone: '{{ old('phone') }}',
                    subject: '{{ old('subject') }}',
                    message: '{{ old('message') }}',
                    errors: {},
                    validateField(field, value) {
                        this.errors[field] = '';
                        if (!value.trim()) {
                            this.errors[field] = 'Field ini wajib diisi';
                            return false;
                        }
                        if (field === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                            this.errors[field] = 'Format email tidak valid';
                            return false;
                        }
                        return true;
                    }
                }">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               x-model="name"
                               @blur="validateField('name', name)"
                               :class="errors.name ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all"
                               required>
                        <p x-show="errors.name" class="text-red-500 text-xs mt-1" x-text="errors.name"></p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               x-model="email"
                               @blur="validateField('email', email)"
                               :class="errors.email ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all"
                               required>
                        <p x-show="errors.email" class="text-red-500 text-xs mt-1" x-text="errors.email"></p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               x-model="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Subjek <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               x-model="subject"
                               @blur="validateField('subject', subject)"
                               :class="errors.subject ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all"
                               required>
                        <p x-show="errors.subject" class="text-red-500 text-xs mt-1" x-text="errors.subject"></p>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6"
                                  x-model="message"
                                  @blur="validateField('message', message)"
                                  :class="errors.message ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-green-500'"
                                  class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-all resize-none"
                                  required>{{ old('message') }}</textarea>
                        <p x-show="errors.message" class="text-red-500 text-xs mt-1" x-text="errors.message"></p>
                    </div>

                    <button type="submit" 
                            class="w-full btn-gradient text-white py-3 px-6 rounded-lg font-semibold shadow-md transform hover:scale-105 transition-all duration-200">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Details -->
                <div class="bg-white rounded-lg shadow-lg p-8 reveal">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 font-heading">Informasi Kontak</h2>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Jl. Raya Buntu - Sampang, Utara Pasar,<br>
                                    Kali Minyak, Bangsa, Kec. Kebasen,<br>
                                    Kabupaten Banyumas, Jawa Tengah 53282
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                                <a href="tel:+628219698146" class="text-green-600 hover:text-green-700 font-medium transition-colors">
                                    (+62) 821-9698-146
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Jam Operasional</h3>
                                <p class="text-gray-600">07:00 - 16:00 WIB</p>
                                <p class="text-sm text-gray-500">Senin - Sabtu</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="bg-white rounded-lg shadow-lg p-8 reveal">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 font-heading">Lokasi Kami</h3>
                    <div class="rounded-lg overflow-hidden shadow-md" style="height: 400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2573485821876!2d109.19545871477359!3d-7.414239194660824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65601c8c7e9a05%3A0x7d5e5e5e5e5e5e5e!2sJl.%20Raya%20Buntu%20-%20Sampang%2C%20Utara%20Pasar%2C%20Kali%20Minyak%2C%20Bangsa%2C%20Kec.%20Kebasen%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah%2053282!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full">
                        </iframe>
                    </div>
                    <p class="text-sm text-gray-500 mt-3 text-center">
                        <a href="https://maps.google.com/?q=Jl.+Raya+Buntu+-+Sampang,+Utara+Pasar,+Kali+Minyak,+Bangsa,+Kec.+Kebasen,+Kabupaten+Banyumas,+Jawa+Tengah+53282" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-green-600 hover:text-green-700 font-medium transition-colors">
                            Buka di Google Maps →
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show toast notification if form is submitted successfully
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast-notification');
                const message = document.getElementById('toast-message');
                message.textContent = '{{ session('success') }}';
                
                toast.classList.remove('hidden', 'translate-x-full');
                toast.classList.add('translate-x-0');
                
                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-full');
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 300);
                }, 5000);
            });
        @endif
    </script>
</x-frontend-layout>
