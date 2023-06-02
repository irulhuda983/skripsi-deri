<template>
  <main class="box-border w-full px-4">
    <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
      <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800">Jenis Barang</h2>

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
                  <div class="font-semibold text-center">Jenis Barang</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Aksi</div>
                </th>
              </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-sm font-medium divide-y divide-gray-100">
              <!-- Row -->
              <tr v-for="(item, i) in jenisBarang" :key="i">
                <td class="p-2">
                  <div class="text-center">{{ i + 1 }}</div>
                </td>
                <td class="p-2">
                  <div class="flex items-center justify-center">
                    <!-- <svg class="shrink-0 mr-2 sm:mr-3" width="36" height="36" viewBox="0 0 36 36">
                      <circle fill="#24292E" cx="18" cy="18" r="18" />
                      <path d="M18 10.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V24c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z" fill="#FFF" />
                    </svg> -->
                    <div class="text-gray-800">{{ item.jenis_barang }}</div>
                  </div>
                </td>
                <td class="p-2">
                  <div class="text-center flex space-x-2 items-center justify-center">
                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" class="w-4 h-4 fill-current opacity-50 shrink-0">
                        <path d="m18.813,10c.309,0,.601-.143.79-.387s.255-.562.179-.861c-.311-1.217-.945-2.329-1.833-3.217l-3.485-3.485c-1.322-1.322-3.08-2.05-4.95-2.05h-4.515C2.243,0,0,2.243,0,5v14c0,2.757,2.243,5,5,5h3c.552,0,1-.448,1-1s-.448-1-1-1h-3c-1.654,0-3-1.346-3-3V5c0-1.654,1.346-3,3-3h4.515c.163,0,.325.008.485.023v4.977c0,1.654,1.346,3,3,3h5.813Zm-6.813-3V2.659c.379.218.732.488,1.05.806l3.485,3.485c.314.314.583.668.803,1.05h-4.338c-.551,0-1-.449-1-1Zm11.122,4.879c-1.134-1.134-3.11-1.134-4.243,0l-6.707,6.707c-.755.755-1.172,1.76-1.172,2.829v1.586c0,.552.448,1,1,1h1.586c1.069,0,2.073-.417,2.828-1.172l6.707-6.707c.567-.567.879-1.32.879-2.122s-.312-1.555-.878-2.121Zm-1.415,2.828l-6.708,6.707c-.377.378-.879.586-1.414.586h-.586v-.586c0-.534.208-1.036.586-1.414l6.708-6.707c.377-.378,1.036-.378,1.414,0,.189.188.293.439.293.707s-.104.518-.293.707Z"/>
                        </svg>
                    </button>
                    <button class="btn bg-red-500 hover:bg-red-600 text-white">
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

    <!-- modal delete -->
    <Modal ref="modalTambah">
      <template v-slot:modal-body>
        <div class="w-full bg-white">
          <div class="w-full">
            <div class="border-b font-semibold text-xl box-border w-full p-4">Tambah Jenis Barang</div>
            <div class="w-full box-border p-4">
              <div class="flex items-center justify-between">
                <label for="jenis_barang" class="block text-sm font-medium leading-6 text-gray-900">Jenis Barang</label>
                <!-- <div class="text-sm">
                  <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div> -->
              </div>
              <div class="mt-2">
                <input id="jenis_barang" v-model="payload.jenis_barang" type="text" autocomplete="off" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
            <div class="flex justify-end items-center space-x-3">
              <button
                @click.prevent="deleteData"
                class="px-4 py-2 rounded bg-green-500 text-white text-xs font-semibold border border-green-500 hover:bg-transparent hover:text-green-500"
              >
                Ya, hapus
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
    const jenisBarang = ref([])
    const jenisBarangRepo = RepositoryFactory.get("jenisBarang")
    const params = reactive({
      filter: "",
      page: 1,
      limit: 10,
      sort: "created_at:desc",
    })

    const payload = reactive({
      jenis_barang: ""
    })

    const modalTambah = ref()

    const fetchData = async () => {
      try {
        const { data } = await jenisBarangRepo.get(params)

        jenisBarang.value = data.data
        // toast.success("Success Notification !", {
        //   position: toast.POSITION.TOP_RIGHT,
        //   autoClose: 1000,
        // })
      } catch (error) {
        console.log(error)
      }
    }

    // open modal delete
    const openModalTambah = () => {
      modalTambah.value.open = true
      // modalDelete.value.open = true
    };

    // open modal delete
    const closeModalTambah = () => {
      modalTambah.value.open = false
      // modalDelete.value.open = true
    };

    onMounted(() => {
      fetchData()
    })

    return {
      jenisBarang,
      jenisBarangRepo,
      payload,
      params,
      fetchData,
      modalTambah,
      openModalTambah,
      closeModalTambah,
    }
  },
}
</script>