<template>
  <div class="flex flex-col col-span-full sm:col-span-12 bg-white shadow-lg rounded-sm border border-gray-200">
    <header class="px-5 py-4 border-b border-gray-100 flex items-center">
      <h2 class="font-semibold text-gray-800">Riwayat Prediksi</h2>
    </header>
    <!-- Chart built with Chart.js 3 -->
    <!-- Change the height attribute to adjust the chart height -->
    <!-- <LineChart :data="chartData" width="595" height="248" /> -->
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
            </tr>
          </thead>
          <!-- Table body -->
          <tbody class="text-sm font-medium divide-y divide-gray-100">
            <!-- Row -->
            <tr v-for="(item, i) in data" :key="i">
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
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>  
</template>


<script>
import { onMounted, ref, computed } from 'vue'
import LineChart from '../../charts/LineChart02.vue'

// Import utilities
import { tailwindConfig } from '../../utils/Utils'

export default {
  name: 'DashboardCard08',
  components: {
    LineChart,
  },
  props: ['data'],
  setup(props) {
    const chartData = ref({
      labels: props.data.tanggal,
      datasets: [
        {
          label: 'Average',
          data: props.data.nilai,
          borderColor: tailwindConfig().theme.colors.green[500],
          fill: false,
          borderWidth: 2,
          tension: 0,
          pointRadius: 0,
          pointHoverRadius: 3,
          pointBackgroundColor: tailwindConfig().theme.colors.green[500],
        },
      ],
    })

    onMounted(() => {
      console.log(props.data)
    })

    return {
      chartData,
    } 
  }
}
</script>