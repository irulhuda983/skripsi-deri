<template>
    <main class="box-border w-full px-4">
        <header class="py-4 border-b border-gray-100 flex items-center justify-between">
            <h1 class="font-semibold text-gray-800">Detail Prediksi</h1>

            <a href="#" @click.prevent="router.go(-1)" class="hover:text-blue-400">Kembali</a>
        </header>
        <div class="mt-4 px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">

            <div class="w-full box-border flex">
                <div class="w-1/2 text-gray-800">
                    <h1 class="underline font-bold mb-3">Informasi Barang</h1>
                    <table>
                        <tr>
                            <td class="pr-5">Nama Barang</td>
                            <td>:</td>
                            <td class="pl-3 capitalize">{{ prediksi.nama_barang }}</td>
                        </tr>

                        <tr>
                            <td class="pr-5">Jenis Barang</td>
                            <td>:</td>
                            <td class="pl-3 capitalize">{{ prediksi.jenis_barang }}</td>
                        </tr>

                        <tr>
                            <td class="pr-5">Stock</td>
                            <td>:</td>
                            <td class="pl-3">{{ prediksi.permintaan }}</td>
                        </tr>

                        <tr>
                            <td class="pr-5">K. Harga</td>
                            <td>:</td>
                            <td class="pl-3 capitalize">{{ prediksi.kriteria_harga }}</td>
                        </tr>

                        <tr>
                            <td class="pr-5 pt-5 font-bold">Hasil</td>
                            <td class="pt-5">:</td>
                            <td class="pl-3 pt-5 font-bold underline capitalize">{{ prediksi.hasil }}</td>
                        </tr>
                    </table>
                </div>

                <div class="w-1/2">
                    <h1 class="underline font-bold mb-3">Hasil Perhitungan</h1>
                    <table class="w-full text-xs">
                        <thead>
                            <tr>
                                <th rowspan="2" class="border border-gray-400">Atribut</th>
                                <th rowspan="2" class="border border-gray-400">Nilai</th>
                                <th colspan="2" class="border border-gray-400">Hasil</th>
                            </tr>
                            <tr>
                                <th class="border border-gray-400">Habis</th>
                                <th class="border border-gray-400">Lebih</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="border border-gray-400 p-2">Probalilitas</td>
                                <td class="border border-gray-400 p-2"></td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.prob.habis.prob }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.prob.lebih.prob }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-2">Jenis Barang</td>
                                <td class="border border-gray-400 p-2">{{ prediksi.prediksi?.jenis_barang.value }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.jenis_barang.nilai.habis }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.jenis_barang.nilai.lebih }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-2">Kriteria Harga</td>
                                <td class="border border-gray-400 p-2">{{ prediksi.prediksi?.kriteria.value }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.kriteria.nilai.habis }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.kriteria.nilai.lebih }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-2">Stock</td>
                                <td class="border border-gray-400 p-2">{{ prediksi.prediksi?.permintaan.value }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.permintaan.nilai.habis }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.permintaan.nilai.lebih }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 p-2">Hasil</td>
                                <td class="border border-gray-400 p-2">{{ prediksi.prediksi?.hasil.value }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.hasil.nilai.habis }}</td>
                                <td class="border border-gray-400 p-2 text-right">{{ prediksi.prediksi?.hasil.nilai.lebih }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-5">
                        Dikarenakan Nilai Habis lebih {{ prediksi.prediksi?.hasil.value == 'habis' ? 'besar' : 'kecil' }} dari Nilai Lebih Maka Hasilnya adalah <span class="italic font-bold capitalize">{{ prediksi.prediksi?.hasil.value }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { RepositoryFactory } from "@/repositories/RepositoryFactory"

export default {
    setup() {
        const prediksi = ref([])
        const prediksiRepo = RepositoryFactory.get("prediksi")
        const router = useRouter()
        const route = useRoute()

        const getPrediksi = async () => {
            try{
                const { data } = await prediksiRepo.detail(route.params.id)

                prediksi.value = data.data
            }catch(e) {
                console.log(e)
            }
        }

        onMounted(() => {
            getPrediksi()
        })

        return { prediksi, router, route }
    },
}
</script>