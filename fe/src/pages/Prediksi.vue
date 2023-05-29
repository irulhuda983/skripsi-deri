<template>
  <main class="box-border w-full px-4">
    <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
      <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800">Jenis Barang</h2>

        <div>
          <!-- Add view button -->
          <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
              <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                  <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
              <span class="hidden xs:block ml-2">Prediksi</span>
          </button>
        </div>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nama Barang</label>
                <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Jenis Barang</label>
                <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-1">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Permintaan</label>
                <div class="mt-2">
                    <input type="number" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Kriteria Harga</label>
                <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Bulan</label>
                <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
        </div>
      </div>
    </div>
  </main>
</template>