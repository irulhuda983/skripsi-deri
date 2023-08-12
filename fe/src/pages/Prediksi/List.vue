<template>
  <main class="box-border w-full px-4">
    <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
      <header class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-800">List History Prediksi</h2>

        <div>
          <!-- Add view button -->
          <router-link :to="{name: 'addPrediksi'}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
              <span class="hidden xs:block ml-2">Prediksi</span>
          </router-link>
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
              <tr v-for="(item, i) in prediksi" :key="i">
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
                    <router-link :to="{name: 'detailPrediksi', params: { id: item.id }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 opacity-80">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>

                    </router-link>
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
    const prediksi = ref([])
    const idPrediksi = ref(null)
    const prediksiRepo = RepositoryFactory.get("prediksi")
    const params = reactive({
      filter: "",
      hasil: null,
      page: 1,
      limit: 10,
      sort: "created_at:desc",
    })

    const loadingSave = ref(false)

    const modalDelete = ref()

    const fetchData = async () => {
      try {
        const { data } = await prediksiRepo.getList()

        prediksi.value = data.data
      } catch (error) {
        console.log(error)
      }
    }

    // delete data
    const deleteData = async () => {
      try {
        const res = await prediksiRepo.delete(idPrediksi.value);

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

    // open modal delete
    const openModalDelete = (id) => {
      idPrediksi.value = id;
      modalDelete.value.open = true;
      // modalDelete.value.open = true
    }

    // close modal delete
    const closeModalDelete = () => {
      idPrediksi.value = null;
      modalDelete.value.open = false;
    }

    onMounted(() => {
      fetchData()
    })

    return {
      idPrediksi,
      prediksi,
      modalDelete,
      params,
      fetchData,
      deleteData,
      openModalDelete,
      closeModalDelete,
    }
  },
}
</script>