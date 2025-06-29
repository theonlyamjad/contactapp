<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Business') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-2xl pb-5 border-b border-gray-200">Edit Business | {{ $business->business_name }}</h3>
                    <form action="{{ route('business.update', $business->id) }}" method="POST" class="space-y-8 pt-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="business_name" class="block text-sm font-medium text-gray-700">
                                    Business Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="business_name" id="business_name" value="{{ old('business_name',$business->business_name) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('business_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700">
                                    Contact Email <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="contact_email" id="contact_email" value="{{ old('contact_email',$business->contact_email) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('contact_email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6">
                            <div>
                                <label for="city_id" class="block text-sm font-medium text-gray-700">
                                    City
                                </label>
                                <select name="city_id" id="city_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ $business->city_id == $city->id ? 'selected' : '' }}>{{ $city->ville }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">
                                    Category
                                </label>
                                <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                    <option value="">Select Category</option>
                                    <option value="Technology" {{ $business->category == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Food" {{ $business->category == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Retail" {{ $business->category == 'Retail' ? 'selected' : '' }}>Clothing</option>
                                    <option value="Finance" {{ $business->category == 'Finance' ? 'selected' : '' }}>Finance</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6">
                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <input type="text" name="website" id="website" value="{{ old('website',$business->website) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('website')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location',$business->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm">
                                @error('location')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="pt-6">
                            <h4 class="font-semibold pt-5 border-b border-gray-200 pb-3">Tags</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pt-4">
                                @foreach ($tags as $tag)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="tag{{$tag->id}}" name="tags[]" value="{{$tag->id}}" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ in_array($tag->id, $business->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label for="tag{{$tag->id}}" class="ml-2 block text-sm text-gray-900"> {{$tag->tag_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-4">
                            <a class="bg-gray-500 text-white py-2 px-4 rounded-full hover:bg-gray-600 transition" href="{{ route('business.index') }}">Cancel</a>
                            <button class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
