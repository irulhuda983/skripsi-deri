<template>
  <main class="box-border w-full px-4">
    <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
      <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800">Stock Barang</h2>

        <div>
          <!-- Add view button -->
          <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="openModalTambah()">
              <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                  <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
              <span class="hidden xs:block ml-2">Add</span>
          </button>
        </div>
      </header>
      <div class="p-3">
        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm">
              <tr>
                <th class="p-2" width="10">
                  <div class="font-semibold text-left">No</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Nama Barang</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Jenis Barang</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">stock</div>
                </th>
                <!-- <th class="p-2">
                  <div class="font-semibold text-center">Stock</div>
                </th> -->
                <th class="p-2">
                  <div class="font-semibold text-center">Kriteria Harga</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Hasil</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Aksi</div>
                </th>
              </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-sm font-medium divide-y divide-gray-100">
              <!-- Row -->
              <tr v-for="(item, i) in stockBarang" :key="i">
                <td class="p-2">
                  <div class="text-center">{{ i + 1 }}</div>
                </td>
                <td class="p-2">
                  <div class="text-center">{{ item.nama_barang }}</div>
                </td>
                <td class="p-2">
                  <div class="text-center">{{ item.jenis_barang }}</div>
                </td>
                <!-- <td class="p-2">
                  <div class="text-center">{{ item.bulan }}</div>
                </td> -->
                <td class="p-2">
                  <div class="text-center">{{ item.permintaan }}</div>
                </td>
                <td class="p-2">
                  <div class="text-center">{{ item.kriteria_harga }}</div>
                </td>
                <td class="p-2">
                  <div class="text-center">{{ item.hasil }}</div>
                </td>
                <td class="p-2">
                  <div class="text-center flex space-x-2 items-center justify-center">
                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click="openModalUpdate(item.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" class="w-4 h-4 fill-current opacity-50 shrink-0">
                        <path d="m18.813,10c.309,0,.601-.143.79-.387s.255-.562.179-.861c-.311-1.217-.945-2.329-1.833-3.217l-3.485-3.485c-1.322-1.322-3.08-2.05-4.95-2.05h-4.515C2.243,0,0,2.243,0,5v14c0,2.757,2.243,5,5,5h3c.552,0,1-.448,1-1s-.448-1-1-1h-3c-1.654,0-3-1.346-3-3V5c0-1.654,1.346-3,3-3h4.515c.163,0,.325.008.485.023v4.977c0,1.654,1.346,3,3,3h5.813Zm-6.813-3V2.659c.379.218.732.488,1.05.806l3.485,3.485c.314.314.583.668.803,1.05h-4.338c-.551,0-1-.449-1-1Zm11.122,4.879c-1.134-1.134-3.11-1.134-4.243,0l-6.707,6.707c-.755.755-1.172,1.76-1.172,2.829v1.586c0,.552.448,1,1,1h1.586c1.069,0,2.073-.417,2.828-1.172l6.707-6.707c.567-.567.879-1.32.879-2.122s-.312-1.555-.878-2.121Zm-1.415,2.828l-6.708,6.707c-.377.378-.879.586-1.414.586h-.586v-.586c0-.534.208-1.036.586-1.414l6.708-6.707c.377-.378,1.036-.378,1.414,0,.189.188.293.439.293.707s-.104.518-.293.707Z"/>
                        </svg>
                    </button>
                    <button class="btn bg-red-500 hover:bg-red-600 text-white" @click="openModalDelete(item.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="w-4 h-4 fill-current opacity-50 shrink-0">
                          <g>
                            <path d="M490.667,96c0-17.673-14.327-32-32-32h-80.555C364.632,25.757,328.549,0.13,288,0h-64   c-40.549,0.13-76.632,25.757-90.112,64H53.333c-17.673,0-32,14.327-32,32l0,0c0,17.673,14.327,32,32,32H64v266.667   C64,459.468,116.532,512,181.333,512h149.333C395.468,512,448,459.468,448,394.667V128h10.667   C476.34,128,490.667,113.673,490.667,96z M384,394.667C384,424.122,360.122,448,330.667,448H181.333   C151.878,448,128,424.122,128,394.667V128h256V394.667z"/>
                            <path d="M202.667,384c17.673,0,32-14.327,32-32V224c0-17.673-14.327-32-32-32s-32,14.327-32,32v128   C170.667,369.673,184.994,384,202.667,384z"/>
                            <path d="M309.333,384c17.673,0,32-14.327,32-32V224c0-17.673-14.327-32-32-32s-32,14.327-32,32v128   C277.333,369.673,291.66,384,309.333,384z"/>
                          </g>
                        </svg>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>

    <!-- modal tambah -->
    <Modal ref="modalTambah">
      <template v-slot:modal-body>
        <div class="w-full bg-white">
          <div class="w-full">
            <div class="border-b font-semibold text-xl box-border w-full p-4">Tambah Stock Barang</div>
            <div class="w-full box-border p-4">
              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="jenis_barang" class="block text-sm font-medium leading-6 text-gray-900">Nama Barang</label>
                </div>
                <div class="mt-2">
                  <input id="nama_barang" v-model="payload.nama_barang" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="jenis_barang" class="block text-sm font-medium leading-6 text-gray-900">Jenis Barang</label>
                </div>
                <div class="mt-2">
                  <select id="jenis_barang" v-model="payload.jenis_barang_id" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Jenis Barang</option>
                    <option v-for="(item, i) in optJenis" :key="i" :value="item.id">{{ item.jenis_barang }}</option>
                  </select>
                </div>
              </div>

              <!-- <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="bulan" class="block text-sm font-medium leading-6 text-gray-900">Bulan</label>
                </div>
                <div class="mt-2">
                  <select id="bulan" v-model="payload.bulan" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Bulan</option>
                    <option v-for="(item, i) in bulan" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div> -->

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="permintaan" class="block text-sm font-medium leading-6 text-gray-900">Permintaan</label>
                </div>
                <div class="mt-2">
                  <input id="permintaan" v-model="payload.permintaan" type="number" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="kriteria_harga" class="block text-sm font-medium leading-6 text-gray-900">Kriteria Harga</label>
                </div>
                <div class="mt-2">
                  <select id="kriteria_harga" v-model="payload.kriteria_harga" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Kategori</option>
                    <option v-for="(item, i) in k_harga" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="hasil" class="block text-sm font-medium leading-6 text-gray-900">Hasil</label>
                </div>
                <div class="mt-2">
                  <select id="hasil" v-model="payload.hasil" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Hasil</option>
                    <option v-for="(item, i) in hasil" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div>

            </div>
            <div class="flex justify-end items-center space-x-3 box-border px-4 py-2">
              <button
                @click.prevent="storeData"
                class="px-4 py-2 rounded bg-indigo-600 text-white text-xs font-semibold border border-indigo-600 hover:bg-transparent hover:text-indigo-600"
              >
                Simpan
              </button>
              <button
                @click.prevent="closeModalTambah"
                class="px-4 py-2 rounded bg-red-500 text-white text-xs font-semibold border border-red-500 hover:bg-transparent hover:text-red-500"
              >
                Batal
              </button>
            </div>
          </div>
        </div>
      </template>
    </Modal>
    <!-- end modal tambah -->

    <!-- modal update -->
    <Modal ref="modalUpdate">
      <template v-slot:modal-body>
        <div class="w-full bg-white">
          <div class="w-full">
            <div class="border-b font-semibold text-xl box-border w-full p-4">Ubah Stock Barang</div>
            <div class="w-full box-border p-4">
              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="jenis_barang" class="block text-sm font-medium leading-6 text-gray-900">Nama Barang</label>
                </div>
                <div class="mt-2">
                  <input id="nama_barang" v-model="payload.nama_barang" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="jenis_barang" class="block text-sm font-medium leading-6 text-gray-900">Jenis Barang</label>
                </div>
                <div class="mt-2">
                  <select id="jenis_barang" v-model="payload.jenis_barang_id" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Jenis Barang</option>
                    <option v-for="(item, i) in optJenis" :key="i" :value="item.id">{{ item.jenis_barang }}</option>
                  </select>
                </div>
              </div>

              <!-- <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="bulan" class="block text-sm font-medium leading-6 text-gray-900">Bulan</label>
                </div>
                <div class="mt-2">
                  <select id="bulan" v-model="payload.bulan" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Bulan</option>
                    <option v-for="(item, i) in bulan" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div> -->

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="permintaan" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                </div>
                <div class="mt-2">
                  <input id="permintaan" v-model="payload.permintaan" type="number" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="kriteria_harga" class="block text-sm font-medium leading-6 text-gray-900">Kriteria Harga</label>
                </div>
                <div class="mt-2">
                  <select id="kriteria_harga" v-model="payload.kriteria_harga" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Kategori</option>
                    <option v-for="(item, i) in k_harga" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div>

              <div class="mb-2">
                <div class="flex items-center justify-between">
                  <label for="hasil" class="block text-sm font-medium leading-6 text-gray-900">Hasil</label>
                </div>
                <div class="mt-2">
                  <select id="hasil" v-model="payload.hasil" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Hasil</option>
                    <option v-for="(item, i) in hasil" :key="i" :value="item.value">{{ item.text }}</option>
                  </select>
                </div>
              </div>

            </div>
            <div class="flex justify-end items-center space-x-3 box-border px-4 py-2">
              <button
                @click.prevent="updateData"
                class="px-4 py-2 rounded bg-indigo-600 text-white text-xs font-semibold border border-indigo-600 hover:bg-transparent hover:text-indigo-600"
              >
                Simpan
              </button>
              <button
                @click.prevent="closeModalUpdate"
                class="px-4 py-2 rounded bg-red-500 text-white text-xs font-semibold border border-red-500 hover:bg-transparent hover:text-red-500"
              >
                Batal
              </button>
            </div>
          </div>
        </div>
      </template>
    </Modal>
    <!-- end modal update -->

    <!-- modal delete -->
    <Modal ref="modalDelete">
      <template v-slot:modal-body>
        <div class="w-full bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="w-full flex space-x-5">
            <div
              class="flex-none w-20 h-20 rounded bg-red-700 text-white flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                />
              </svg>
            </div>

            <div class="flex-1">
              <div class="mb-3 text-base font-semibold">
                Apakah Anda yakin ingin menghapus data ?
              </div>
              <div class="mb-3 text-sm">
                Data yang dihapus tidak bisa akan hilang secara permanen, apa anda
                ingin melanjutkan ?
              </div>

              <div class="flex justify-end items-center space-x-3">
                <button
                  @click.prevent="deleteData"
                  class="px-4 py-2 rounded bg-indigo-500 text-white text-xs font-semibold border border-indigo-500 hover:bg-transparent hover:text-indigo-500"
                >
                  Ya, hapus
                </button>
                <button
                  @click.prevent="closeModalDelete"
                  class="px-4 py-2 rounded bg-red-500 text-white text-xs font-semibold border border-red-500 hover:bg-transparent hover:text-red-500"
                >
                  Batal
                </button>
              </div>
            </div>
          </div>
        </div>
      </template>
    </Modal>
    <!-- end modal delete -->
  </main>
</template>

<script>
import { ref, reactive, defineAsyncComponent, onMounted } from "vue"
import { RepositoryFactory } from "@/repositories/RepositoryFactory"
import { toast } from 'vue3-toastify'

const Modal = defineAsyncComponent(() => import("@/components/Modal.vue"));

export default {
  components: {Modal},
  setup() {
    const stockBarang = ref([])
    const idStock = ref(null)
    const stockBarangRepo = RepositoryFactory.get("stockBarang")
    const jenisBarangRepo = RepositoryFactory.get("jenisBarang")
    const params = reactive({
      filter: "",
      hasil: null,
      page: 1,
      limit: 10,
      sort: "created_at:desc",
    })

    const payload = reactive({
      nama_barang: '',
      jenis_barang_id: '',
      bulan: '',
      permintaan: null,
      kriteria_harga: '',
      hasil: '',
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

    const hasil =ref([
      {value: 'habis', text: 'Habis'},
      {value: 'lebih', text: 'Lebih'},
    ])

    const optJenis = ref([])

    const loadingSave = ref(false)

    const modalTambah = ref()
    const modalUpdate = ref()
    const modalDelete = ref()

    const fetchData = async () => {
      try {
        const { data } = await stockBarangRepo.get(params)

        stockBarang.value = data.data
      } catch (error) {
        console.log(error)
      }
    }

    const getJenisbarang = async () => {
      try {
        const { data } = await jenisBarangRepo.get(params)

        optJenis.value = data.data
      } catch (error) {
        console.log(error)
      }
    }

    const storeData = async () => {
      if (loadingSave.value) return;
      loadingSave.value = true;
      try {
        await stockBarangRepo.store(payload);

        loadingSave.value = false;
        toast.success("Berhasil Tambah Data !", {
          position: toast.POSITION.TOP_RIGHT,
          autoClose: 1000,
        })

        closeModalTambah()
        fetchData()
      } catch (e) {
        if (e.response.status == 422) {
          let err = e.response.data.errors;

          // if (err.nama) {
          //   error.nama = err.nama[0];
          // }
        }

        loadingSave.value = false;
      }
    }

    const updateData = async() => {
      if (loadingSave.value) return;
      loadingSave.value = true;
      try {
        await stockBarangRepo.update(idStock.value, payload);

        loadingSave.value = false;

        fetchData()
        closeModalUpdate()
        toast.success("Berhasil update data !", {
          position: toast.POSITION.TOP_RIGHT,
          autoClose: 1000,
        })

      } catch (e) {
        if (e.response.status == 422) {
          let err = e.response.data.errors;

          // if (err.nama) {
          //   error.nama = err.nama[0];
          // }
        }

        loadingSave.value = false;
      }
    }

    // delete data
    const deleteData = async () => {
      try {
        const res = await stockBarangRepo.delete(idStock.value);

        if (res.status === 200) {
          fetchData()
          toast.success("Berhasil hapus data !", {
            position: toast.POSITION.TOP_RIGHT,
            autoClose: 1000,
          })
        }
      } catch (e) {
        console.log(e)
      }
      closeModalDelete()
    }

    // open modal tambah
    const openModalTambah = () => {
      modalTambah.value.open = true
      // modalDelete.value.open = true
    };

    // open modal tambah
    const closeModalTambah = () => {
      payload.nama_barang = ''
      payload.jenis_barang_id = ''
      payload.permintaan = null
      payload.bulan = ''
      payload.kriteria_harga = ''
      payload.hasil = ''
      modalTambah.value.open = false
      // modalDelete.value.open = true
    };

    // open modal update
    const openModalUpdate = async (id) => {
      try {
        const { data } = await stockBarangRepo.detail(id)

        payload.nama_barang = data.data.nama_barang
        payload.jenis_barang_id = data.data.jenis_barang_id
        payload.permintaan = data.data.permintaan
        payload.bulan = data.data.bulan
        payload.kriteria_harga = data.data.kriteria_harga
        payload.hasil = data.data.hasil

        idStock.value = id
        modalUpdate.value.open = true
      } catch (error) {
        console.log(error)
      }
      // modalDelete.value.open = true
    };

    // open modal update
    const closeModalUpdate = () => {
      idStock.value = null
      payload.nama_barang = ''
      payload.jenis_barang_id = ''
      payload.permintaan = null
      payload.bulan = ''
      payload.kriteria_harga = ''
      payload.hasil = ''
      modalUpdate.value.open = false
      // modalDelete.value.open = true
    }

    // open modal delete
    const openModalDelete = (id) => {
      idStock.value = id;
      modalDelete.value.open = true;
      // modalDelete.value.open = true
    }

    // close modal delete
    const closeModalDelete = () => {
      idStock.value = null;
      modalDelete.value.open = false;
    }

    onMounted(() => {
      fetchData()
      getJenisbarang()
    })

    return {
      idStock,
      stockBarang,
      stockBarangRepo,
      modalTambah,
      modalUpdate,
      modalDelete,
      payload,
      bulan,
      k_harga,
      hasil,
      optJenis,
      params,
      fetchData,
      getJenisbarang,
      storeData,
      updateData,
      deleteData,
      openModalTambah,
      closeModalTambah,
      openModalUpdate,
      closeModalUpdate,
      openModalDelete,
      closeModalDelete,
    }
  },
}
</script>