<x-admin-layout>
    <div class="mb-6 max-w-3xl mx-auto">
        <a href="{{ route('admin.packages.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">&larr;
            Back to Packages</a>
        <h3 class="text-white text-3xl font-medium">{{ isset($package) ? 'Edit Package' : 'Create New Package' }}</h3>
    </div>

    <div class="max-w-3xl mx-auto bg-surface shadow-md rounded-xl overflow-hidden border border-white/5 p-8">
        <form
            action="{{ isset($package) ? route('admin.packages.update', $package->id) : route('admin.packages.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if(isset($package))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Package Name</label>
                    <input type="text" name="name" value="{{ old('name', $package->name ?? '') }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary"
                        required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary">{{ old('description', $package->description ?? '') }}</textarea>
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Price (IDR)</label>
                    <input type="number" name="price" value="{{ old('price', $package->price ?? '') }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary"
                        required>
                    @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Batch Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Batch Number</label>
                    <input type="number" name="batch_number"
                        value="{{ old('batch_number', $package->batch_number ?? 1) }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary"
                        required>
                    @error('batch_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Start Date</label>
                    <input type="date" name="start_date"
                        value="{{ old('start_date', isset($package) && $package->start_date ? $package->start_date->format('Y-m-d') : '') }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary">
                    @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- End Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">End Date</label>
                    <input type="date" name="end_date"
                        value="{{ old('end_date', isset($package) && $package->end_date ? $package->end_date->format('Y-m-d') : '') }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary focus:border-primary">
                    @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Active Status -->
                <div class="col-span-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $package->is_active ?? true) ? 'checked' : '' }}
                            class="form-tick appearance-none h-6 w-6 border border-white/20 rounded-md checked:bg-primary checked:border-transparent focus:outline-none">
                        <span class="text-white font-medium">Active Package</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-bold rounded-lg shadow-lg shadow-primary/30 transition">
                    {{ isset($package) ? 'Update Package' : 'Create Package' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>