<x-admin-layout>
    <x-slot name="title">System Settings</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">System Settings</h1>
        <p class="text-sm text-gray-600 mt-1">Manage company information, SEO settings, and system configuration</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Company Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Company Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="settings_company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="settings[company_name]" id="settings_company_name"
                           value="{{ Setting::get('company_name', 'PT Lestari Jaya Bangsa') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_company_established" class="block text-sm font-medium text-gray-700 mb-2">Established Year</label>
                    <input type="text" name="settings[company_established]" id="settings_company_established"
                           value="{{ Setting::get('company_established', '1992') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="md:col-span-2">
                    <label for="settings_company_tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                    <input type="text" name="settings[company_tagline]" id="settings_company_tagline"
                           value="{{ Setting::get('company_tagline', 'Food & Herbal — Health and Flavour, United in One Choice') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="md:col-span-2">
                    <label for="settings_company_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="settings[company_address]" id="settings_company_address" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ Setting::get('company_address', 'Jl. Raya Buntu - Sampang, Utara Pasar, Kali Minyak, Bangsa, Kec. Kebasen, Kabupaten Banyumas, Jawa Tengah 53282') }}</textarea>
                </div>
                <div>
                    <label for="settings_company_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="settings[company_phone]" id="settings_company_phone"
                           value="{{ Setting::get('company_phone', '(+62) 821-9698-146') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_company_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="settings[company_email]" id="settings_company_email"
                           value="{{ Setting::get('company_email', '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_working_hours" class="block text-sm font-medium text-gray-700 mb-2">Working Hours</label>
                    <input type="text" name="settings[working_hours]" id="settings_working_hours"
                           value="{{ Setting::get('working_hours', '07:00 - 16:00') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">SEO Settings</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="settings_seo_title" class="block text-sm font-medium text-gray-700 mb-2">Default Meta Title</label>
                    <input type="text" name="settings[seo_title]" id="settings_seo_title"
                           value="{{ Setting::get('seo_title', 'PT Lestari Jaya Bangsa - Food & Herbal Products') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_seo_keywords" class="block text-sm font-medium text-gray-700 mb-2">Default Keywords</label>
                    <input type="text" name="settings[seo_keywords]" id="settings_seo_keywords"
                           value="{{ Setting::get('seo_keywords', 'herbal, food, natural products, halal, BPOM') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="md:col-span-2">
                    <label for="settings_seo_description" class="block text-sm font-medium text-gray-700 mb-2">Default Meta Description</label>
                    <textarea name="settings[seo_description]" id="settings_seo_description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ Setting::get('seo_description', 'PT Lestari Jaya Bangsa provides high-quality herbal and processed food products, committed to prioritising both health and taste.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Social Media Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="settings_social_facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" name="settings[social_facebook]" id="settings_social_facebook"
                           value="{{ Setting::get('social_facebook', '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_social_instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="settings[social_instagram]" id="settings_social_instagram"
                           value="{{ Setting::get('social_instagram', '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_social_twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter/X URL</label>
                    <input type="url" name="settings[social_twitter]" id="settings_social_twitter"
                           value="{{ Setting::get('social_twitter', '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="settings_social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                    <input type="url" name="settings[social_linkedin]" id="settings_social_linkedin"
                           value="{{ Setting::get('social_linkedin', '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
            </div>
        </div>

        <!-- Google Maps -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Google Maps</h2>
            <div>
                <label for="settings_google_maps_api_key" class="block text-sm font-medium text-gray-700 mb-2">Google Maps API Key</label>
                <input type="text" name="settings[google_maps_api_key]" id="settings_google_maps_api_key"
                       value="{{ Setting::get('google_maps_api_key', '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <p class="mt-1 text-xs text-gray-500">Enter your Google Maps API key for map integration</p>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                Save Settings
            </button>
        </div>
    </form>
</x-admin-layout>


