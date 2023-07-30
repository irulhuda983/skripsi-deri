<template>
  <main class="box-border w-full px-4">
    <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
      <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800">Prediksi</h2>

        <div>
          <!-- Add view button -->
          <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="getPrediksi()">
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
                    <input v-model="payload.nama_barang" type="text" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Jenis Barang</label>
                <div class="mt-2">
                    <select id="jenis_barang" v-model="payload.jenis_barang_id" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Pilih Jenis Barang</option>
                        <option v-for="(item, i) in optJenis" :key="i" :value="item.id">{{ item.jenis_barang }}</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-1">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Permintaan / Stock</label>
                <div class="mt-2">
                    <input v-model="payload.permintaan" type="number" name="first-name" id="first-name" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Kriteria Harga</label>
                <div class="mt-2">
                    <select id="kriteria_harga" v-model="payload.kriteria_harga" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Pilih Kategori</option>
                        <option v-for="(item, i) in k_harga" :key="i" :value="item.value">{{ item.text }}</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Bulan</label>
                <div class="mt-2">
                    <select id="bulan" v-model="payload.bulan" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Pilih Bulan</option>
                        <option v-for="(item, i) in bulan" :key="i" :value="item.value">{{ item.text }}</option>
                    </select>
                </div>
            </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import { RepositoryFactory } from "@/repositories/RepositoryFactory"
import { useRouter, useRoute } from 'vue-router'
import { toast } from 'vue3-toastify'

export default {
    setup() {
        const jenisBarangRepo = RepositoryFactory.get("jenisBarang")
        const prediksiRepo = RepositoryFactory.get("prediksi")

        const router = useRouter()

        const payload = reactive({
            nama_barang: '',
            jenis_barang_id: '',
            bulan: '',
            permintaan: null,
            kriteria_harga: '',
        })

        const bulan = ref([
            {value: 'januari', text: 'Januari'},
            {value: 'februari', text: 'Februari'},
            {value: 'maret', text: 'Maret'},
            {value: 'april', text: 'April'},
            {value: 'mei', text: 'Mei'},
            {value: 'juni', text: 'Juni'},
            {value: 'juli', text: 'Juli'},
            {value: 'agustus', text: 'Agustus'},
            {value: 'september', text: 'September'},
            {value: 'oktober', text: 'Oktober'},
            {value: 'november', text: 'November'},
            {value: 'desember', text: 'Desember'},
        ])

        const k_harga = ref([
            {value: 'murah', text: 'Murah'},
            {value: 'mahal', text: 'Mahal'},
        ])

        const optJenis = ref([])

        const getJenisbarang = async () => {
            try {
                const { data } = await jenisBarangRepo.get()

                optJenis.value = data.data
            } catch (error) {
                console.log(error)
            }
        }

        const getPrediksi = async () => {
            try {
                const { data } = await prediksiRepo.store(payload)

                router.push({ name: 'detailPrediksi', params: { id: data.data.id }})
            } catch (error) {
                console.log(error)
            }
        }

        onMounted(() => {
            getJenisbarang()
        })

        return { payload, bulan, k_harga, optJenis, getPrediksi }
    },
}
</script>